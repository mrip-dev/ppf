@extends('layout.layout')
@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">

<style>
    .cc-page {
        --cc-bg: #eef2f6;
        --cc-panel: #ffffff;
        --cc-ink: #1b2531;
        --cc-muted: #6b7a90;
        --cc-border: #e2e8f0;
        --cc-blue: #0ea5e9;
        --cc-blue-dark: #0369a1;
        --cc-cyan: #06b6d4;
        --cc-orange: #f97316;
        --cc-green: #16a34a;
        --cc-red: #ef4444;
        --cc-amber: #f59e0b;
        --cc-radius: 16px;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        color: var(--cc-ink);
        background: var(--cc-bg);
        padding: 24px 0 40px;
    }
    .cc-page .d-none { display: none !important; }
    .cc-page * { box-sizing: border-box; }

    /* ---- alerts ---- */
    .cc-alert {
        border-radius: 12px;
        padding: 14px 18px;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 16px;
        border: 1px solid transparent;
    }
    .cc-alert-success { background: #ecfdf5; color: #065f46; border-color: #a7f3d0; }
    .cc-alert-error   { background: #fef2f2; color: #991b1b; border-color: #fecaca; }

    /* ---- header panel ---- */
    .cc-panel {
        background: var(--cc-panel);
        border-radius: var(--cc-radius);
        border: 1px solid var(--cc-border);
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04), 0 8px 24px -12px rgba(15, 23, 42, 0.08);
        overflow: hidden;
    }
    .cc-header {
        background: linear-gradient(120deg, #0c4a6e 0%, #0369a1 45%, #0ea5e9 100%);
        padding: 22px 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        position: relative;
    }
    .cc-header h4 {
        margin: 0;
        color: #f0f9ff;
        font-weight: 700;
        letter-spacing: 0.02em;
        font-size: 22px;
        text-align: center;
    }
    .cc-live-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: #4ade80;
        box-shadow: 0 0 0 rgba(74, 222, 128, 0.6);
        animation: cc-pulse 2s infinite;
        flex-shrink: 0;
    }
    @keyframes cc-pulse {
        0% { box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.6); }
        70% { box-shadow: 0 0 0 8px rgba(74, 222, 128, 0); }
        100% { box-shadow: 0 0 0 0 rgba(74, 222, 128, 0); }
    }

    .cc-body { padding: 24px 28px 28px; }

    /* ---- sensor readouts ---- */
    .cc-sensor-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 14px;
        margin-bottom: 26px;
    }
    .cc-sensor-tile {
        background: #0f172a;
        border-radius: 14px;
        padding: 16px 14px;
        text-align: center;
        position: relative;
        overflow: hidden;
        border: 1px solid #1e293b;
    }
    .cc-sensor-tile::before {
        content: "";
        position: absolute;
        inset: 0;
        background: radial-gradient(120px 60px at 50% 0%, rgba(255,255,255,0.08), transparent 70%);
        pointer-events: none;
    }
    .cc-sensor-tile.-temp { border-top: 3px solid var(--cc-orange); }
    .cc-sensor-tile.-humi { border-top: 3px solid var(--cc-green); }
    .cc-sensor-value {
        font-family: 'JetBrains Mono', monospace;
        font-weight: 700;
        font-size: 30px;
        color: #f8fafc;
        line-height: 1.1;
        letter-spacing: 0.01em;
    }
    .cc-sensor-tile.-temp .cc-sensor-value { color: #fdba74; text-shadow: 0 0 14px rgba(249, 115, 22, 0.45); }
    .cc-sensor-tile.-humi .cc-sensor-value { color: #86efac; text-shadow: 0 0 14px rgba(34, 197, 94, 0.45); }
    .cc-sensor-label {
        margin-top: 6px;
        font-size: 11.5px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #94a3b8;
    }

    /* ---- section header row (title + save button) ---- */
    .cc-section-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 2px solid var(--cc-border);
        flex-wrap: wrap;
        gap: 10px;
    }
    .cc-section-title {
        margin: 0;
        font-size: 20px;
        font-weight: 800;
        color: var(--cc-green);
        letter-spacing: 0.01em;
    }

    /* ---- device cards ---- */
    .cc-device-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: 16px;
    }
    .cc-device-grid.-wide { grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); }

    .cc-device-card {
        background: var(--cc-panel);
        border: 1px solid var(--cc-border);
        border-radius: 16px;
        padding: 16px 18px 18px;
        transition: box-shadow .15s ease, transform .15s ease;
    }
    .cc-device-card:hover {
        box-shadow: 0 6px 18px -8px rgba(15, 23, 42, 0.18);
        transform: translateY(-1px);
    }

    /* color-coded by device type */
    .cc-device-card[data-type="fan"]  { background: #f0fdf4; border-color: #bbf7d0; }
    .cc-device-card[data-type="cool"] { background: #f0f9ff; border-color: #bae6fd; }
    .cc-device-card[data-type="heat"] { background: #fef2f2; border-color: #fecaca; }
    .cc-device-card[data-type="static"] { background: #f8fafc; border-color: var(--cc-border); }

    .cc-device-card[data-type="fan"]  .cc-device-name { color: #15803d; }
    .cc-device-card[data-type="cool"] .cc-device-name { color: #0284c7; }
    .cc-device-card[data-type="heat"] .cc-device-name { color: #b91c1c; }
    .cc-device-card[data-type="static"] .cc-device-name { color: var(--cc-muted); }

    .cc-device-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
    }
    .cc-device-name {
        margin: 0;
        font-size: 18px;
        font-weight: 800;
    }
    .cc-status-pill {
        font-size: 10.5px;
        font-weight: 800;
        letter-spacing: 0.04em;
        padding: 4px 12px;
        border-radius: 999px;
        background: #dcfce7;
        color: #15803d;
        border: 1.5px solid #86efac;
    }
    .cc-status-pill.-off { background: #f1f5f9; color: #64748b; border-color: #cbd5e1; }

    .cc-device-body { display: flex; flex-direction: column; gap: 12px; }
    .cc-field-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }
    .cc-field-label {
        display: block;
        font-size: 11px;
        font-weight: 800;
        color: var(--cc-muted);
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 6px;
    }
    .cc-field-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
        border: 1.5px solid var(--cc-border);
        border-radius: 10px;
        padding: 8px 10px;
    }
    .cc-field-box:focus-within {
        border-color: var(--cc-blue);
        box-shadow: 0 0 0 2px rgba(14, 165, 233, 0.2);
    }
    .cc-field-unit {
        font-size: 11.5px;
        font-weight: 700;
        color: #94a3b8;
        flex-shrink: 0;
        margin-left: 6px;
    }
    .cc-field-static {
        font-family: 'JetBrains Mono', monospace;
        font-weight: 800;
        font-size: 17px;
        color: var(--cc-ink);
    }

    .cc-page .cc-inline-input {
        width: 100%;
        border: none !important;
        background: transparent !important;
        padding: 0;
        font-family: 'JetBrains Mono', monospace;
        font-weight: 800;
        font-size: 17px;
        color: var(--cc-ink);
        text-align: left;
    }
    .cc-page .cc-inline-input:focus { outline: none; }

    /* ---- action bar ---- */
    .cc-actions {
        margin-top: 22px;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .cc-btn {
        border: none;
        border-radius: 10px;
        padding: 10px 22px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: filter .15s ease, transform .15s ease;
    }
    .cc-btn:hover { filter: brightness(1.08); transform: translateY(-1px); }
    .cc-btn:disabled { opacity: .5; cursor: not-allowed; transform: none; filter: none; }
    .cc-btn.-primary  { background: var(--cc-blue); color: #fff; }
    .cc-btn.-success  { background: var(--cc-green); color: #fff; }
    .cc-btn.-secondary{ background: #e2e8f0; color: var(--cc-ink); }
    .cc-actions-error {
        font-size: 13px;
        font-weight: 600;
        color: var(--cc-red);
    }
    .cc-dirty-note {
        font-size: 12px;
        font-weight: 600;
        color: var(--cc-amber);
        display: none;
    }
    .cc-dirty-note.-visible { display: inline; }
</style>

<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <div class="col-xl-12 col-lg-12 col-sm-12 table cc-page">
            @if(session('success'))
            <div class="cc-alert cc-alert-success">
                {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="cc-alert cc-alert-error">
                {{ session('error') }}
            </div>
            @endif

            <div class="cc-panel mt-2">
                <div class="cc-header">
                    <span class="cc-live-dot"></span>
                    <h4>Online Climate Control System — Shed 1</h4>
                </div>

                <form id="inline-edit-form" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="cc-body">

                        <!-- sensor readouts (read-only, live) -->
                        <div class="cc-sensor-grid">
                            <div class="cc-sensor-tile -temp">
                                <div class="cc-sensor-value"><span id="room_temp">50</span></div>
                                <div class="cc-sensor-label">House Temperature</div>
                            </div>
                            <div class="cc-sensor-tile -temp">
                                <div class="cc-sensor-value" id="brooder_temp">30.5</div>
                                <div class="cc-sensor-label">Brooder Temperature</div>
                            </div>
                            <div class="cc-sensor-tile -humi">
                                <div class="cc-sensor-value" id="humidity">20</div>
                                <div class="cc-sensor-label">Humidity</div>
                            </div>
                            <div class="cc-sensor-tile -temp">
                                <div class="cc-sensor-value"><span id="outside_temp">50</span></div>
                                <div class="cc-sensor-label">Outside Temperature</div>
                            </div>
                            <div class="cc-sensor-tile -humi">
                                <div class="cc-sensor-value" id="outside-humi">20</div>
                                <div class="cc-sensor-label">Outside Humidity</div>
                            </div>
                        </div>

                        <!-- section head: fan controls + save -->
                        <div class="cc-section-head">
                            <p class="cc-section-title">12 Fan &amp; Device Controls</p>
                            <div class="d-flex align-items-center" style="gap:10px;">
                                <span id="dirty-note" class="cc-dirty-note">Unsaved changes</span>
                                <button type="submit" id="btn-save" class="cc-btn -success" disabled>Save Setpoints</button>
                            </div>
                        </div>

                        <!-- device cards -->
                        <div class="cc-device-grid">
                            @for($i=1;$i<=12;$i++)
                            <div class="cc-device-card" data-device="fan{{$i}}" data-mode="cool" data-type="fan">
                                <div class="cc-device-head">
                                    <p class="cc-device-name">Fan {{$i}}</p>
                                    <span class="cc-status-pill">ON</span>
                                </div>
                                <div class="cc-device-body">
                                    <div class="cc-field-grid">
                                        <div>
                                            <span class="cc-field-label">On Temp</span>
                                            <div class="cc-field-box">
                                                <input type="text" class="cc-inline-input temp-input" name="fan{{$i}}_on_temp" id="fan{{$i}}-on-temp-input">
                                                <span class="cc-field-unit">&deg;C</span>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="cc-field-label">Off Temp</span>
                                            <div class="cc-field-box">
                                                <input type="text" class="cc-inline-input temp-input" name="fan{{$i}}_off_temp" id="fan{{$i}}-off-temp-input">
                                                <span class="cc-field-unit">&deg;C</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cc-field-grid">
                                        <div>
                                            <span class="cc-field-label">On Time</span>
                                            <div class="cc-field-box">
                                                <input type="text" class="cc-inline-input time-input" name="fan{{$i}}_on_time" id="fan{{$i}}-on-time-input">
                                                <span class="cc-field-unit">Sec</span>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="cc-field-label">Off Time</span>
                                            <div class="cc-field-box">
                                                <input type="text" class="cc-inline-input time-input" name="fan{{$i}}_off_time" id="fan{{$i}}-off-time-input">
                                                <span class="cc-field-unit">Sec</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor

                            <!-- Cool 1 -->
                            <div class="cc-device-card" data-device="cool1" data-mode="cool" data-type="cool">
                                <div class="cc-device-head">
                                    <p class="cc-device-name">Cool 1</p>
                                    <span class="cc-status-pill">ON</span>
                                </div>
                                <div class="cc-device-body">
                                    <div class="cc-field-grid">
                                        <div>
                                            <span class="cc-field-label">On Temp</span>
                                            <div class="cc-field-box">
                                                <input type="text" class="cc-inline-input temp-input" name="pad1_on_temp" id="cool1-on-temp-input">
                                                <span class="cc-field-unit">&deg;C</span>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="cc-field-label">Off Temp</span>
                                            <div class="cc-field-box">
                                                <input type="text" class="cc-inline-input temp-input" name="pad1_off_temp" id="cool1-off-temp-input">
                                                <span class="cc-field-unit">&deg;C</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cc-field-grid">
                                        <div>
                                            <span class="cc-field-label">On Time</span>
                                            <div class="cc-field-box">
                                                <input type="text" class="cc-inline-input time-input" name="pad1_on_time" id="cool1-on-time-input">
                                                <span class="cc-field-unit">Sec</span>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="cc-field-label">Off Time</span>
                                            <div class="cc-field-box">
                                                <input type="text" class="cc-inline-input time-input" name="pad1_off_time" id="cool1-off-time-input">
                                                <span class="cc-field-unit">Sec</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cool 2 -->
                            <div class="cc-device-card" data-device="cool2" data-mode="cool" data-type="cool">
                                <div class="cc-device-head">
                                    <p class="cc-device-name">Cool 2</p>
                                    <span class="cc-status-pill">ON</span>
                                </div>
                                <div class="cc-device-body">
                                    <div class="cc-field-grid">
                                        <div>
                                            <span class="cc-field-label">On Temp</span>
                                            <div class="cc-field-box">
                                                <input type="text" class="cc-inline-input temp-input" name="pad2_on_temp" id="cool2-on-temp-input">
                                                <span class="cc-field-unit">&deg;C</span>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="cc-field-label">Off Temp</span>
                                            <div class="cc-field-box">
                                                <input type="text" class="cc-inline-input temp-input" name="pad2_off_temp" id="cool2-off-temp-input">
                                                <span class="cc-field-unit">&deg;C</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cc-field-grid">
                                        <div>
                                            <span class="cc-field-label">On Time</span>
                                            <div class="cc-field-box">
                                                <input type="text" class="cc-inline-input time-input" name="pad2_on_time" id="cool2-on-time-input">
                                                <span class="cc-field-unit">Sec</span>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="cc-field-label">Off Time</span>
                                            <div class="cc-field-box">
                                                <input type="text" class="cc-inline-input time-input" name="pad2_off_time" id="cool2-off-time-input">
                                                <span class="cc-field-unit">Sec</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Heater -->
                            <div class="cc-device-card" data-device="heater" data-mode="heat" data-type="heat">
                                <div class="cc-device-head">
                                    <p class="cc-device-name">Heater</p>
                                    <span class="cc-status-pill">ON</span>
                                </div>
                                <div class="cc-device-body">
                                    <div class="cc-field-grid">
                                        <div>
                                            <span class="cc-field-label">On Temp</span>
                                            <div class="cc-field-box">
                                                <input type="text" class="cc-inline-input temp-input" name="heat_on_temp" id="heater-on-temp-input">
                                                <span class="cc-field-unit">&deg;C</span>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="cc-field-label">Off Temp</span>
                                            <div class="cc-field-box">
                                                <input type="text" class="cc-inline-input temp-input" name="heat_off_temp" id="heater-off-temp-input">
                                                <span class="cc-field-unit">&deg;C</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cc-field-grid">
                                        <div>
                                            <span class="cc-field-label">On Time</span>
                                            <div class="cc-field-box">
                                                <input type="text" class="cc-inline-input time-input" name="heat_on_time" id="heater-on-time-input">
                                                <span class="cc-field-unit">Sec</span>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="cc-field-label">Off Time</span>
                                            <div class="cc-field-box">
                                                <input type="text" class="cc-inline-input time-input" name="heat_off_time" id="heater-off-time-input">
                                                <span class="cc-field-unit">Sec</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Light (no persisted setpoints yet — read-only) -->
                            <div class="cc-device-card" data-type="static">
                                <div class="cc-device-head">
                                    <p class="cc-device-name">Light</p>
                                    <span class="cc-status-pill -off">OFF</span>
                                </div>
                                <div class="cc-device-body">
                                    <div class="cc-field-grid">
                                        <div>
                                            <span class="cc-field-label">On Temp</span>
                                            <div class="cc-field-box"><span class="cc-field-static">45.0</span><span class="cc-field-unit">&deg;C</span></div>
                                        </div>
                                        <div>
                                            <span class="cc-field-label">Off Temp</span>
                                            <div class="cc-field-box"><span class="cc-field-static">45.0</span><span class="cc-field-unit">&deg;C</span></div>
                                        </div>
                                    </div>
                                    <div class="cc-field-grid">
                                        <div>
                                            <span class="cc-field-label">On Time</span>
                                            <div class="cc-field-box"><span class="cc-field-static">45.0</span><span class="cc-field-unit">Sec</span></div>
                                        </div>
                                        <div>
                                            <span class="cc-field-label">Off Time</span>
                                            <div class="cc-field-box"><span class="cc-field-static">45.0</span><span class="cc-field-unit">Sec</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- wide extras (read-only, no backing fields yet) -->
                        <div class="cc-device-grid -wide mt-3">
                            <div class="cc-device-card" data-type="static">
                                <div class="cc-device-head">
                                    <p class="cc-device-name">Extra 1</p>
                                    <span class="cc-status-pill -off">OFF</span>
                                </div>
                                <div class="cc-device-body">
                                    <div class="cc-field-grid">
                                        <div>
                                            <span class="cc-field-label">On Temp</span>
                                            <div class="cc-field-box"><span class="cc-field-static">45.0</span><span class="cc-field-unit">&deg;C</span></div>
                                        </div>
                                        <div>
                                            <span class="cc-field-label">Off Temp</span>
                                            <div class="cc-field-box"><span class="cc-field-static">45.0</span><span class="cc-field-unit">&deg;C</span></div>
                                        </div>
                                    </div>
                                    <div class="cc-field-grid">
                                        <div>
                                            <span class="cc-field-label">On Time</span>
                                            <div class="cc-field-box"><span class="cc-field-static">45.0</span><span class="cc-field-unit">Sec</span></div>
                                        </div>
                                        <div>
                                            <span class="cc-field-label">Off Time</span>
                                            <div class="cc-field-box"><span class="cc-field-static">45.0</span><span class="cc-field-unit">Sec</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="cc-device-card" data-type="static">
                                <div class="cc-device-head">
                                    <p class="cc-device-name">Extra 2</p>
                                    <span class="cc-status-pill -off">OFF</span>
                                </div>
                                <div class="cc-device-body">
                                    <div class="cc-field-grid">
                                        <div>
                                            <span class="cc-field-label">On Temp</span>
                                            <div class="cc-field-box"><span class="cc-field-static">45.0</span><span class="cc-field-unit">&deg;C</span></div>
                                        </div>
                                        <div>
                                            <span class="cc-field-label">Off Temp</span>
                                            <div class="cc-field-box"><span class="cc-field-static">45.0</span><span class="cc-field-unit">&deg;C</span></div>
                                        </div>
                                    </div>
                                    <div class="cc-field-grid">
                                        <div>
                                            <span class="cc-field-label">On Time</span>
                                            <div class="cc-field-box"><span class="cc-field-static">45.0</span><span class="cc-field-unit">Sec</span></div>
                                        </div>
                                        <div>
                                            <span class="cc-field-label">Off Time</span>
                                            <div class="cc-field-box"><span class="cc-field-static">45.0</span><span class="cc-field-unit">Sec</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- form-level messages -->
                        <div class="cc-actions">
                            <span id="form-error-msg" class="cc-actions-error d-none"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div id="data-container">
                <!-- Data will be displayed here -->
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        window.currentData = null;
        var isDirty = false; // true once the user edits a field, until Save is submitted

        // ---- min/max bounds config (real-world decimal values, e.g. 25.5°C) ----
        // Setpoints are entered/displayed as real decimals but stored in the DB
        // as raw integers with the decimal stripped (25.5 -> 255), same scaling
        // already used for the live sensor readouts.
        var TEMP_MIN = 0;      // °C
        var TEMP_MAX = 50;     // °C
        var TIME_MIN = 0;      // seconds
        var TIME_MAX = 9999;   // seconds
        var STEP = 0.1;        // smallest temp increment

        // Device groups this form can edit, mapped to their input id prefixes,
        // and whether they use "cool" logic (On Temp > Off Temp: fans, pads)
        // or "heat" logic (Off Temp > On Temp: brooder heater).
        var EDITABLE_DEVICES = [];
        for (var i = 1; i <= 12; i++) EDITABLE_DEVICES.push({ id: 'fan' + i, mode: 'cool' });
        EDITABLE_DEVICES.push({ id: 'cool1', mode: 'cool' });
        EDITABLE_DEVICES.push({ id: 'cool2', mode: 'cool' });
        EDITABLE_DEVICES.push({ id: 'heater', mode: 'heat' });

        // Raw DB integer -> display decimal (300 -> 30.0)
        function formatTemp(val) {
            if (val === null || val === undefined || val === '') return '';
            var num = parseFloat(val);
            if (isNaN(num)) return '';
            return (num / 10).toFixed(1);
        }

        // Display decimal -> raw DB integer (30.5 -> 305)
        function toRawTemp(val) {
            var num = parseFloat(val);
            if (isNaN(num)) return '';
            return Math.round(num * 10).toString();
        }

        // Fetch data initially
        fetchData();
        // Poll every 10 seconds; skip repopulating inputs while the user has
        // unsaved edits so we never overwrite what they're typing.
        setInterval(function() {
            fetchData();
        }, 10000);

        function fetchData() {
            $.ajax({
                url: "{{ route('fetch.data') }}",
                type: "GET",
                success: function(response) {
                    // Only accept this poll's result if it actually has a
                    // device row. A transient null here must NOT overwrite
                    // currentData we already had — that would wipe out the
                    // form's action/device_id and re-disable Save mid-edit,
                    // even while the user has unsaved changes on screen.
                    if (response.data) {
                        window.currentData = response.data;
                        updateFormAction();
                        $('#btn-save').prop('disabled', false);
                    } else if (!window.currentData) {
                        // We've genuinely never had a valid row — keep Save
                        // disabled and let the console explain why.
                        console.warn('No status data returned for this device.');
                        $('#btn-save').prop('disabled', true);
                    }
                    // else: this poll was empty but we already have a good
                    // currentData from before — ignore it and keep going.

                    updateSensors();
                    if (!isDirty) {
                        populateInputs();
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        function updateSensors() {
            if (!window.currentData) return;
            var data = window.currentData;
            $('#room_temp').text(formatTemp(data.temperature));
            $('#brooder_temp').text(formatTemp(data.temp2_brooder));
            $('#outside_temp').text(formatTemp(data.temp3_outside));
            $('#humidity').text(data.humidity);
        }

        function updateFormAction() {
            if (!window.currentData || !window.currentData.device_id) return;
            var id = window.currentData.device_id;
            $('#inline-edit-form').attr('action', `/cm-shed1/${id}`);
        }

        function populateInputs() {
            if (!window.currentData) return;
            var data = window.currentData;

            @for($i=1;$i<=12;$i++)
            $('#fan{{$i}}-on-temp-input').val(formatTemp(data.fan{{$i}}_on_temp));
            $('#fan{{$i}}-off-temp-input').val(formatTemp(data.fan{{$i}}_off_temp));
            $('#fan{{$i}}-on-time-input').val(data.fan{{$i}}_on_time ?? '');
            $('#fan{{$i}}-off-time-input').val(data.fan{{$i}}_off_time ?? '');
            @endfor

            // cool1
            $('#cool1-on-temp-input').val(formatTemp(data.pad1_on_temp));
            $('#cool1-off-temp-input').val(formatTemp(data.pad1_off_temp));
            $('#cool1-on-time-input').val(data.pad1_on_time ?? '');
            $('#cool1-off-time-input').val(data.pad1_off_time ?? '');

            // cool2
            $('#cool2-on-temp-input').val(formatTemp(data.pad2_on_temp));
            $('#cool2-off-temp-input').val(formatTemp(data.pad2_off_temp));
            $('#cool2-on-time-input').val(data.pad2_on_time ?? '');
            $('#cool2-off-time-input').val(data.pad2_off_time ?? '');

            // heat (brooder) — Off Temp > On Temp
            $('#heater-on-temp-input').val(formatTemp(data.heat_on_temp));
            $('#heater-off-temp-input').val(formatTemp(data.heat_off_temp));
            $('#heater-on-time-input').val(data.heat_on_time ?? '');
            $('#heater-off-time-input').val(data.heat_off_time ?? '');
        }

        /**
         * Strips anything that isn't a digit (or a single decimal point) as
         * the user types, then clamps the numeric value to [min, max]. Values
         * below min are only corrected on blur (see clampMinOnBlur), so
         * partial typing (an empty field, or "0." while entering "0.5")
         * isn't fought mid-keystroke.
         */
        function clampTempInput($el, max) {
            var raw = $el.val();
            var cleaned = raw.replace(/[^0-9.]/g, '');
            var dot = cleaned.indexOf('.');
            if (dot !== -1) {
                cleaned = cleaned.slice(0, dot + 1) + cleaned.slice(dot + 1).replace(/\./g, '');
            }
            if (cleaned !== raw) $el.val(cleaned);

            var num = parseFloat(cleaned);
            if (!isNaN(num) && num > max) {
                cleaned = (Math.round(max * 10) / 10).toFixed(1);
                $el.val(cleaned);
                num = max;
            }
            return isNaN(num) ? null : num;
        }

        function clampTimeInput($el, max) {
            var raw = $el.val();
            var cleaned = raw.replace(/[^0-9]/g, '');
            if (cleaned !== raw) $el.val(cleaned);

            var num = parseInt(cleaned, 10);
            if (!isNaN(num) && num > max) {
                $el.val(String(max));
                num = max;
            }
            return isNaN(num) ? null : num;
        }

        function clampMinOnBlur($el, min, isTemp) {
            var raw = $el.val();
            if (raw === '') return;
            var num = isTemp ? parseFloat(raw) : parseInt(raw, 10);
            if (!isNaN(num) && num < min) {
                $el.val(isTemp ? min.toFixed(1) : String(min));
            }
        }

        /**
         * Enforces this device's bounds live, both temps clamped to
         * [TEMP_MIN, TEMP_MAX], and the On/Off relationship enforced
         * according to device mode:
         *   - "cool" (fans, cool pads): On Temp must stay > Off Temp,
         *     so Off Temp's ceiling is On Temp - STEP.
         *   - "heat" (brooder heater): Off Temp must stay > On Temp,
         *     so On Temp's ceiling is Off Temp - STEP.
         * The user simply cannot type a value that breaks the relationship;
         * there's nothing left to flag as a submit-time error.
         */
        function enforceDeviceBounds(device, mode) {
            var $onTemp  = $('#' + device + '-on-temp-input');
            var $offTemp = $('#' + device + '-off-temp-input');
            var $onTime  = $('#' + device + '-on-time-input');
            var $offTime = $('#' + device + '-off-time-input');

            if (mode === 'heat') {
                // Off Temp drives the ceiling; On Temp must stay below it.
                var offTempVal = clampTempInput($offTemp, TEMP_MAX);
                var onCeiling = (offTempVal !== null) ? Math.max(TEMP_MIN, offTempVal - STEP) : TEMP_MAX;
                clampTempInput($onTemp, onCeiling);
            } else {
                // Cool logic (fans / pads): On Temp drives the ceiling;
                // Off Temp must stay below it.
                var onTempVal = clampTempInput($onTemp, TEMP_MAX);
                var offCeiling = (onTempVal !== null) ? Math.max(TEMP_MIN, onTempVal - STEP) : TEMP_MAX;
                clampTempInput($offTemp, offCeiling);
            }

            clampTimeInput($onTime, TIME_MAX);
            clampTimeInput($offTime, TIME_MAX);
        }

        // Fields are always editable — no Edit/Cancel toggle. Typing marks the
        // form dirty (so polling won't clobber it) and clamps in real time.
        $(document).on('change', '.temp-input, .time-input', function() {
            isDirty = true;
            $('#dirty-note').addClass('-visible');
            var $card = $(this).closest('.cc-device-card');
            var device = $card.data('device');
            var mode = $card.data('mode') || 'cool';
            if (device) enforceDeviceBounds(device, mode);
        });

        /**
         * Arrow-key increment/decrement. These inputs are type="text" (needed
         * for the custom masking/clamping above), so there's no native number
         * spinner — the browser does nothing with Up/Down out of the box.
         * This wires that up manually:
         *   - Up/Down: ±STEP for temps, ±1 for times
         *   - Shift+Up/Down: ±1.0 for temps, ±10 for times (bigger jump)
         * Result is clamped the same way typed input is, including the
         * On/Off relationship for the device's mode.
         */
        $(document).on('keydown', '.temp-input, .time-input', function(e) {
            if (e.key !== 'ArrowUp' && e.key !== 'ArrowDown') return;
            e.preventDefault();

            var $el = $(this);
            var isTemp = $el.hasClass('temp-input');
            var dir = (e.key === 'ArrowUp') ? 1 : -1;
            var step = isTemp ? (e.shiftKey ? 1.0 : STEP) : (e.shiftKey ? 10 : 1);

            var current = parseFloat($el.val());
            if (isNaN(current)) current = isTemp ? TEMP_MIN : TIME_MIN;

            var next = isTemp
                ? Math.round((current + dir * step) * 10) / 10
                : Math.round(current + dir * step);

            // Respect the absolute floor here; the ceiling (including the
            // On/Off relationship) is enforced right after via
            // enforceDeviceBounds, same as if the user had typed the value.
            var floor = isTemp ? TEMP_MIN : TIME_MIN;
            if (next < floor) next = floor;

            $el.val(isTemp ? next.toFixed(1) : String(next));

            isDirty = true;
            $('#dirty-note').addClass('-visible');
            var $card = $el.closest('.cc-device-card');
            var device = $card.data('device');
            var mode = $card.data('mode') || 'cool';
            if (device) enforceDeviceBounds(device, mode);
        });

        // On blur, pull anything left below the minimum back up to it
        // (covers a field emptied then left blank, or a stray "0"), and
        // normalize to one decimal place for display.
        $(document).on('blur', '.temp-input', function() {
            clampMinOnBlur($(this), TEMP_MIN, true);
            var raw = $(this).val();
            if (raw !== '') {
                var num = parseFloat(raw);
                if (!isNaN(num)) $(this).val(num.toFixed(1));
            }
        });
        $(document).on('blur', '.time-input', function() {
            clampMinOnBlur($(this), TIME_MIN, false);
        });

        $('#inline-edit-form').on('submit', function(e) {
            var action = $(this).attr('action');
            if (!action || !window.currentData || !window.currentData.device_id) {
                e.preventDefault();
                $('#form-error-msg').removeClass('d-none').text('Cannot save — device data not loaded yet.');
                return false;
            }

            // Final safety pass — inputs are already clamped as-you-type, but
            // this re-enforces bounds in case fields were filled out of order
            // (e.g. Off Temp typed before On Temp existed).
            EDITABLE_DEVICES.forEach(function (device) {
                enforceDeviceBounds(device.id, device.mode);
            });

            $('#form-error-msg').addClass('d-none').text('');

            // Temp inputs are shown/edited as real decimals (e.g. 25.5) but
            // the DB stores raw integers with the decimal stripped (255) —
            // same convention as the sensor fields. Convert right before the
            // browser serializes the form, so the UI never has to juggle two
            // representations of the same field at once.
            $('.temp-input').each(function() {
                var raw = $(this).val();
                if (raw !== '') $(this).val(toRawTemp(raw));
            });

            isDirty = false; // page will reload/redirect on success, resetting state anyway
        });
    });
</script>
@endsection