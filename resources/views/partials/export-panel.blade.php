@php $pid = 'exp_' . $shed; @endphp

<div class="card mb-4 p-3" id="{{ $pid }}">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="mb-0">Export full records to Excel</h5>
        <small class="text-muted">Auto-refresh: <span data-role="updated">-</span></small>
    </div>

    <form data-role="form" class="row g-2 align-items-end">
        <div class="col-md-3">
            <label>Start date</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label>End date</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label>Interval</label>
            <select name="interval_minutes" class="form-control">
                <option value="10" selected>Every 10 min (like page)</option>
                <option value="5">Every 5 min</option>
                <option value="1">Every 1 min</option>
                <option value="15">Every 15 min</option>
                <option value="30">Every 30 min</option>
                <option value="60">Every 60 min</option>
                <option value="0">All records (raw)</option>
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Generate Excel</button>
            <button type="button" data-role="refresh" class="btn btn-outline-secondary">Refresh</button>
            <button type="button" data-role="clear" class="btn btn-outline-danger">Clear finished</button>
        </div>
    </form>

    <div data-role="msg" class="mt-2"></div>

    <div class="table-responsive">
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Created</th>
                    <th>Range</th>
                    <th>Status</th>
                    <th style="min-width:200px">Progress</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody data-role="rows">
                <tr>
                    <td colspan="6">Loading…</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    (function() {
        const root = document.getElementById(@json($pid));
        const base = @json(url('/exports/'.$shed));
        const csrf = @json(csrf_token());
        const $ = r => root.querySelector('[data-role="' + r + '"]');
        const badge = {
            pending: 'secondary',
            processing: 'primary',
            cancelling: 'warning',
            completed: 'success',
            failed: 'danger',
            cancelled: 'dark',
            stalled: 'warning'
        };
        let timer = null,
            busy = false;

        const esc = s => String(s ?? '').replace(/[&<>"']/g, c => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;'
        } [c]));

        function msg(text, type) {
            $('msg').innerHTML = text ? `<div class="alert alert-${type || 'info'} py-2 mb-0">${esc(text)}</div>` : '';
            if (text) setTimeout(() => $('msg').innerHTML = '', 5000);
        }

        async function call(method, url, body) {
            const r = await fetch(url, {
                method,
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body
            });
            const d = await r.json().catch(() => ({}));
            if (!r.ok) {
                const first = d.errors ? Object.values(d.errors)[0][0] : null;
                throw new Error(first || d.message || 'Request failed (' + r.status + ')');
            }
            return d;
        }

        function render(items) {
            if (!items.length) {
                $('rows').innerHTML = '<tr><td colspan="6" class="text-muted">No exports yet.</td></tr>';
                return;
            }
            $('rows').innerHTML = items.map(e => {
                const bar = ['processing', 'cancelling', 'stalled'].includes(e.status) ? 'progress-bar-striped progress-bar-animated' : '';
                const actions = [
                    e.download ? `<a class="btn btn-sm btn-success" href="${base}/${e.id}/download">Download</a>` : '',
                    e.can_cancel ? `<button class="btn btn-sm btn-warning" data-act="cancel" data-id="${e.id}">Cancel</button>` : '',
                    e.can_retry ? `<button class="btn btn-sm btn-info" data-act="retry" data-id="${e.id}">Retry</button>` : '',
                    e.can_delete ? `<button class="btn btn-sm btn-outline-danger" data-act="delete" data-id="${e.id}">Delete</button>` : '',
                ].join(' ');
                return `<tr>
                <td>${e.id}</td>
                <td>${esc(e.created)}</td>
                <td>${esc(e.range)}<div class="small text-muted">${esc(e.interval)}</div></td>
                <td><span class="badge bg-${badge[e.status] || 'secondary'}">${esc(e.status)}</span>
                    ${e.error ? `<div class="text-danger small">${esc(e.error)}</div>` : ''}
                    ${e.status === 'stalled' ? '<div class="small text-muted">No activity. Retry or delete.</div>' : ''}</td>
                <td>
                    <div class="progress" style="height:8px"><div class="progress-bar ${bar}" style="width:${e.progress}%"></div></div>
                    <small>${e.progress}% (${e.rows.toLocaleString()}${e.total ? ' / ' + e.total.toLocaleString() : ''} rows)</small>
                </td>
                <td class="text-nowrap">${actions}</td>
            </tr>`;
            }).join('');
        }

        function schedule(ms) {
            clearTimeout(timer);
            timer = setTimeout(() => document.hidden ? schedule(ms) : load(), ms);
        }

        async function load() {
            if (busy) return;
            busy = true;
            try {
                const d = await call('GET', base + '/status');
                render(d.items);
                $('updated').textContent = new Date().toLocaleTimeString() + (d.active ? ' (every 3s)' : ' (every 15s)');
                schedule(d.active ? 3000 : 15000);
            } catch (err) {
                $('updated').textContent = 'error';
                schedule(10000);
            } finally {
                busy = false;
            }
        }

        $('form').addEventListener('submit', async ev => {
            ev.preventDefault();
            try {
                const d = await call('POST', base, new FormData(ev.target));
                msg(d.message, 'success');
                load();
            } catch (err) {
                msg(err.message, 'danger');
            }
        });

        $('refresh').addEventListener('click', load);

        $('clear').addEventListener('click', async () => {
            if (!confirm('Remove all completed, failed and cancelled exports and their files?')) return;
            try {
                msg((await call('POST', base + '/clear-finished')).message, 'success');
                load();
            } catch (err) {
                msg(err.message, 'danger');
            }
        });

        $('rows').addEventListener('click', async ev => {
            const b = ev.target.closest('[data-act]');
            if (!b) return;
            const {
                act,
                id
            } = b.dataset;

            if (act === 'delete' && !confirm('Delete export #' + id + ' and its file?')) return;
            if (act === 'cancel' && !confirm('Cancel export #' + id + '?')) return;

            b.disabled = true;
            try {
                const d = act === 'delete' ?
                    await call('DELETE', `${base}/${id}`) :
                    await call('POST', `${base}/${id}/${act}`);
                msg(d.message, 'success');
            } catch (err) {
                msg(err.message, 'danger');
            }
            load();
        });

        document.addEventListener('visibilitychange', () => {
            if (!document.hidden) load();
        });
        load();
    })();
</script>