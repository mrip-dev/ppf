@php $pid = 'purge_' . $shed; @endphp

<div class="card mb-4 p-3 border-danger" id="{{ $pid }}">
    <h5 class="mb-1 text-danger">Delete old records</h5>
    <p class="text-muted small mb-3">
        Permanently removes records for this shed only. Today's records can never be deleted here.
        Export what you need first.
    </p>

    <form data-role="form" class="row g-2 align-items-end">
        <div class="col-md-3">
            <label>Delete</label>
            <select name="mode" data-role="mode" class="form-control">
                <option value="days" selected>Records older than…</option>
                <option value="range">A date range</option>
            </select>
        </div>

        <div class="col-md-3" data-role="daysBox">
            <label>Older than</label>
            <select name="days" class="form-control">
                <option value="7">7 days</option>
                <option value="14">14 days</option>
                <option value="30" selected>30 days</option>
                <option value="60">60 days</option>
                <option value="90">90 days</option>
                <option value="180">180 days</option>
                <option value="365">1 year</option>
            </select>
        </div>

        <div class="col-md-2" data-role="rangeBox" style="display:none">
            <label>From</label>
            <input type="date" name="from" class="form-control">
        </div>
        <div class="col-md-2" data-role="rangeBox" style="display:none">
            <label>To</label>
            <input type="date" name="to" class="form-control" max="{{ now()->subDay()->toDateString() }}">
        </div>

        <div class="col-md-3">
            <button type="button" data-role="preview" class="btn btn-outline-secondary w-100">Preview</button>
        </div>
    </form>

    <div data-role="result" class="mt-3" style="display:none">
        <div class="alert alert-warning mb-2" data-role="summary"></div>

        <div class="d-flex flex-wrap align-items-center gap-2">
            <input type="text" data-role="confirm" class="form-control" style="max-width:240px"
                placeholder="DELETE OLD RECORDS" autocomplete="off">
            <button type="button" data-role="delete" class="btn btn-danger" disabled>Delete these records</button>
        </div>
        <small class="text-muted">Type <code>DELETE OLD RECORDS</code> to enable the button.</small>
    </div>

    <div data-role="progressBox" class="mt-3" style="display:none">
        <div class="progress" style="height:10px">
            <div data-role="bar" class="progress-bar bg-danger progress-bar-striped progress-bar-animated" style="width:0%"></div>
        </div>
        <small data-role="progressText" class="text-muted"></small>
    </div>

    <div data-role="msg" class="mt-2"></div>
</div>

<script>
    (function() {
        const root = document.getElementById(@json($pid));
        const csrf = @json(csrf_token());
        const urls = {
            preview: @json(route('records.old.preview', $shed)),
            purge: @json(route('records.old.purge', $shed)),
        };
        const $ = r => root.querySelector('[data-role="' + r + '"]');
        const $$ = r => root.querySelectorAll('[data-role="' + r + '"]');
        const REQUIRED = 'DELETE OLD RECORDS';
        let total = 0,
            running = false;

        const esc = s => String(s ?? '').replace(/[&<>"']/g, c => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;'
        } [c]));

        function msg(text, type) {
            $('msg').innerHTML = text ? `<div class="alert alert-${type || 'info'} py-2 mb-0">${esc(text)}</div>` : '';
        }

        async function post(url, extra) {
            const fd = new FormData($('form'));
            Object.entries(extra || {}).forEach(([k, v]) => fd.append(k, v));
            const r = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: fd
            });
            const d = await r.json().catch(() => ({}));
            if (!r.ok) {
                const first = d.errors ? Object.values(d.errors)[0][0] : null;
                throw new Error(first || d.message || 'Request failed (' + r.status + ')');
            }
            return d;
        }

        function resetResult() {
            $('result').style.display = 'none';
            $('confirm').value = '';
            $('delete').disabled = true;
            total = 0;
        }

        function syncMode() {
            const range = $('mode').value === 'range';
            $$('daysBox').forEach(e => e.style.display = range ? 'none' : '');
            $$('rangeBox').forEach(e => e.style.display = range ? '' : 'none');
            resetResult();
        }

        $('mode').addEventListener('change', syncMode);
        $('form').addEventListener('change', () => {
            if (!running) resetResult();
        });

        $('confirm').addEventListener('input', () => {
            $('delete').disabled = running || total === 0 || $('confirm').value.trim() !== REQUIRED;
        });

        $('preview').addEventListener('click', async () => {
            msg('');
            resetResult();
            const btn = $('preview');
            btn.disabled = true;
            btn.textContent = 'Counting…';
            try {
                const d = await post(urls.preview);
                total = d.count;
                if (!total) {
                    msg('No records match. Nothing to delete.', 'info');
                    return;
                }
                $('summary').innerHTML =
                    `<strong>${d.count.toLocaleString()}</strong> records will be deleted` +
                    (d.min ? ` (from <strong>${esc(d.min)}</strong> to <strong>${esc(d.max)}</strong>)` : '') + '.';
                $('result').style.display = '';
            } catch (err) {
                msg(err.message, 'danger');
            } finally {
                btn.disabled = false;
                btn.textContent = 'Preview';
            }
        });

        $('delete').addEventListener('click', async () => {
            if (running || !total) return;
            if (!confirm('Permanently delete ' + total.toLocaleString() + ' records? This cannot be undone.')) return;

            running = true;
            let deleted = 0;
            $('delete').disabled = true;
            $('preview').disabled = true;
            $('confirm').disabled = true;
            $('progressBox').style.display = '';
            msg('');

            try {
                while (true) {
                    const d = await post(urls.purge, {
                        confirmation: $('confirm').value.trim()
                    });
                    deleted += d.deleted;
                    const pct = Math.min(100, Math.round(deleted / total * 100));
                    $('bar').style.width = pct + '%';
                    $('progressText').textContent = pct + '% (' + deleted.toLocaleString() + ' / ' + total.toLocaleString() + ' deleted)';
                    if (d.done) break;
                }
                $('bar').classList.remove('progress-bar-animated');
                msg(deleted.toLocaleString() + ' records deleted. Reloading…', 'success');
                setTimeout(() => location.reload(), 1500);
            } catch (err) {
                $('bar').classList.remove('progress-bar-animated');
                msg('Stopped after ' + deleted.toLocaleString() + ' records: ' + err.message +
                    '. You can run Preview and Delete again to continue.', 'danger');
                running = false;
                $('preview').disabled = false;
                $('confirm').disabled = false;
            }
        });
    })();
</script>