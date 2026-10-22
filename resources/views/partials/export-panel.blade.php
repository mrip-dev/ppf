@php $pid = 'exp_' . $shed; @endphp

<style>
    #{{ $pid }} .exp-banner { border-left: 4px solid #4361ee; background: #f1f4ff; border-radius: 6px; padding: 12px 14px; }
    #{{ $pid }} .exp-indeterminate { height: 8px; }
    #{{ $pid }} .exp-meta { font-size: 12px; color: #6c757d; }
    #{{ $pid }} .exp-spin { display:inline-block; width:14px; height:14px; border:2px solid #fff; border-right-color:transparent; border-radius:50%; animation: expspin .7s linear infinite; vertical-align:-2px; margin-right:6px; }
    @keyframes expspin { to { transform: rotate(360deg); } }
</style>

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
            <button type="submit" data-role="submit" class="btn btn-primary">Generate Excel</button>
            <button type="button" data-role="refresh" class="btn btn-outline-secondary">Refresh</button>
            <button type="button" data-role="clear" class="btn btn-outline-danger">Clear finished</button>
        </div>
    </form>

    <div data-role="msg" class="mt-2"></div>

    {{-- Shown while the POST request itself is running (sync queue / slow start) --}}
    <div data-role="starting" class="exp-banner mt-3" style="display:none">
        <div class="d-flex justify-content-between">
            <strong>Generating your export…</strong>
            <span class="exp-meta">Elapsed: <span data-role="elapsed">0s</span></span>
        </div>
        <div class="progress exp-indeterminate mt-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:100%"></div>
        </div>
        <div class="exp-meta mt-2">
            Large exports can take several minutes. Please keep this page open until it finishes.
        </div>
    </div>

    <div class="table-responsive">
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Created</th>
                    <th>Range</th>
                    <th>Status</th>
                    <th style="min-width:240px">Progress</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody data-role="rows">
                <tr><td colspan="6">Loading…</td></tr>
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
            pending: 'secondary', processing: 'primary', cancelling: 'warning',
            completed: 'success', failed: 'danger', cancelled: 'dark', stalled: 'warning'
        };
        const stageText = {
            pending: 'Queued, waiting to start…',
            cancelling: 'Cancelling…',
            stalled: 'No activity detected',
        };

        let timer = null, busy = false;
        let submitting = false, submitStart = 0, elapsedTimer = null;
        const samples = {};   // id -> {t, rows} first sample, for speed/ETA

        const esc = s => String(s ?? '').replace(/[&<>"']/g, c => ({
            '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
        } [c]));

        const fmtDur = s => {
            s = Math.max(0, Math.round(s));
            const m = Math.floor(s / 60), h = Math.floor(m / 60);
            if (h) return h + 'h ' + (m % 60) + 'm';
            if (m) return m + 'm ' + (s % 60) + 's';
            return s + 's';
        };

        function msg(text, type, sticky) {
            $('msg').innerHTML = text ? `<div class="alert alert-${type || 'info'} py-2 mb-0">${esc(text)}</div>` : '';
            if (text && !sticky) setTimeout(() => $('msg').innerHTML = '', 6000);
        }

        async function call(method, url, body) {
            const r = await fetch(url, {
                method,
                headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body
            });
            const d = await r.json().catch(() => ({}));
            if (!r.ok) {
                const first = d.errors ? Object.values(d.errors)[0][0] : null;
                const err = new Error(first || d.message || 'Request failed (' + r.status + ')');
                err.status = r.status;
                throw err;
            }
            return d;
        }

        function progressCell(e) {
            const running = ['processing', 'cancelling', 'stalled'].includes(e.status);
            const rows = Number(e.rows || 0), total = Number(e.total || 0);

            // Still counting rows / not started → indeterminate bar
            if (e.status === 'pending' || (e.status === 'processing' && !total)) {
                return `<div class="progress" style="height:8px">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:100%"></div>
                        </div>
                        <small class="text-muted">${e.status === 'pending' ? stageText.pending : 'Counting records…'}</small>`;
            }

            let extra = '';
            if (e.status === 'processing' && total && rows > 0) {
                const now = Date.now() / 1000;
                const s = samples[e.id] || (samples[e.id] = { t: now, rows });
                const dt = now - s.t, dr = rows - s.rows;
                if (dt > 4 && dr > 0) {
                    const rate = dr / dt;
                    extra = ` · ${Math.round(rate).toLocaleString()} rows/s · ETA ${fmtDur((total - rows) / rate)}`;
                }
                if (e.progress >= 99) extra = ' · Finalizing (zipping files)…';
            }

            const bar = running ? 'progress-bar-striped progress-bar-animated' : '';
            const color = e.status === 'completed' ? 'bg-success' : (e.status === 'failed' ? 'bg-danger' : '');
            return `<div class="progress" style="height:8px">
                        <div class="progress-bar ${bar} ${color}" style="width:${e.progress}%"></div>
                    </div>
                    <small>${e.progress}% (${rows.toLocaleString()}${total ? ' / ' + total.toLocaleString() : ''} rows)${extra}</small>`;
        }

        function render(items) {
            if (!items.length) {
                $('rows').innerHTML = '<tr><td colspan="6" class="text-muted">No exports yet.</td></tr>';
                return;
            }
            $('rows').innerHTML = items.map(e => {
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
                    <td>${progressCell(e)}</td>
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
                const fast = d.active || submitting;
                $('updated').textContent = new Date().toLocaleTimeString() + (fast ? ' (every 2s)' : ' (every 15s)');
                schedule(fast ? 2000 : 15000);
            } catch (err) {
                $('updated').textContent = 'error';
                schedule(submitting ? 3000 : 10000);
            } finally {
                busy = false;
            }
        }

        function setSubmitting(on) {
            submitting = on;
            const btn = $('submit');
            btn.disabled = on;
            btn.innerHTML = on ? '<span class="exp-spin"></span>Generating…' : 'Generate Excel';
            $('starting').style.display = on ? '' : 'none';
            clearInterval(elapsedTimer);
            if (on) {
                submitStart = Date.now();
                $('elapsed').textContent = '0s';
                elapsedTimer = setInterval(() => {
                    $('elapsed').textContent = fmtDur((Date.now() - submitStart) / 1000);
                }, 1000);
                schedule(1500);   // start fast polling right away
            }
        }

        $('form').addEventListener('submit', async ev => {
            ev.preventDefault();
            if (submitting) return;
            setSubmitting(true);
            try {
                const d = await call('POST', base, new FormData(ev.target));
                msg(d.message || 'Export finished.', 'success');
            } catch (err) {
                // Gateway timeout / dropped connection: job may still be running server-side
                if (!err.status || [502, 503, 504].includes(err.status)) {
                    msg('The request took too long, but the export may still be running. Watch the list below.', 'warning', true);
                } else {
                    msg(err.message, 'danger');
                }
            } finally {
                setSubmitting(false);
                load();
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
            const { act, id } = b.dataset;

            if (act === 'delete' && !confirm('Delete export #' + id + ' and its file?')) return;
            if (act === 'cancel' && !confirm('Cancel export #' + id + '?')) return;

            b.disabled = true;
            try {
                const d = act === 'delete'
                    ? await call('DELETE', `${base}/${id}`)
                    : await call('POST', `${base}/${id}/${act}`);
                msg(d.message, 'success');
            } catch (err) {
                msg(err.message, 'danger');
            }
            load();
        });

        document.addEventListener('visibilitychange', () => { if (!document.hidden) load(); });
        load();
    })();
</script>