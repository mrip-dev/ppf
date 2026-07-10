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

    /* ---- device cards ---- */
    .cc-device-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
        gap: 14px;
    }
    .cc-device-grid.-wide { grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); }

    .cc-device-card {
        background: var(--cc-panel);
        border: 1px solid var(--cc-border);
        border-radius: 12px;
        overflow: hidden;
        transition: box-shadow .15s ease, transform .15s ease;
    }
    .cc-device-card:hover {
        box-shadow: 0 6px 18px -8px rgba(15, 23, 42, 0.18);
        transform: translateY(-1px);
    }
    .cc-device-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 12px;
        background: #f8fafc;
        border-bottom: 1px solid var(--cc-border);
    }
    .cc-device-name {
        margin: 0;
        font-size: 13.5px;
        font-weight: 700;
        color: var(--cc-ink);
    }
    .cc-status-chips { display: flex; gap: 4px; }
    .cc-chip {
        font-size: 9.5px;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        padding: 3px 7px;
        border-radius: 999px;
    }
    .cc-chip.-on  { background: #dcfce7; color: #15803d; }
    .cc-chip.-off { background: #fee2e2; color: #b91c1c; }

    .cc-device-body { padding: 10px 12px 12px; display: flex; flex-direction: column; gap: 7px; }
    .cc-metric-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }
    .cc-metric-label {
        font-size: 11.5px;
        color: var(--cc-muted);
        font-weight: 500;
        flex-shrink: 0;
        width: 62px;
    }
    .cc-metric-value {
        flex: 1;
        text-align: center;
        font-family: 'JetBrains Mono', monospace;
        font-weight: 700;
        font-size: 13px;
        border-radius: 7px;
        padding: 4px 6px;
        background: #fff;
        border: 1.5px solid transparent;
    }
    .cc-metric-value.-on  { border-color: var(--cc-green); color: #15803d; }
    .cc-metric-value.-off { border-color: var(--cc-red); color: #b91c1c; }

    .cc-page .temp-input,
    .cc-page .time-input {
        border-radius: 7px !important;
        border: 1px solid rgba(255,255,255,0.6) !important;
        font-family: 'JetBrains Mono', monospace;
        font-weight: 600;
    }

    /* ---- action bar ---- */
    .cc-actions {
        margin-top: 22px;
        display: flex;
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
    .cc-btn.-primary  { background: var(--cc-blue); color: #fff; }
    .cc-btn.-success  { background: var(--cc-green); color: #fff; }
    .cc-btn.-secondary{ background: #e2e8f0; color: var(--cc-ink); }
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

                        <!-- sensor readouts -->
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

                        <!-- device cards -->
                        <div class="cc-device-grid">
                            @for($i=1;$i<=12;$i++)
                            <div class="cc-device-card">
                                <div class="cc-device-head">
                                    <p class="cc-device-name">Fan {{$i}}</p>
                                    <div class="cc-status-chips">
                                        <span class="badge badge-success cc-chip -on">On</span>
                                        <span class="badge badge-danger cc-chip -off">Off</span>
                                    </div>
                                </div>
                                <div class="cc-device-body">
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">On Temp</div>
                                        <div class="cc-metric-value -on">
                                            <span class="view-mode" id="fan{{$i}}-on-temp">45.0</span>
                                            <input type="text" class="form-control form-control-sm edit-mode d-none text-center bg-white text-dark temp-input" name="fan{{$i}}_on_temp" id="fan{{$i}}-on-temp-input" style="height: 24px; font-size: 11px; padding: 2px;">
                                        </div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">Off Temp</div>
                                        <div class="cc-metric-value -off">
                                            <span class="view-mode" id="fan{{$i}}-off-temp">45.0</span>
                                            <input type="text" class="form-control form-control-sm edit-mode d-none text-center bg-white text-dark temp-input" name="fan{{$i}}_off_temp" id="fan{{$i}}-off-temp-input" style="height: 24px; font-size: 11px; padding: 2px;">
                                        </div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">On Time</div>
                                        <div class="cc-metric-value -on">
                                            <span class="view-mode" id="fan{{$i}}-on-time">45.0</span>
                                            <input type="text" class="form-control form-control-sm edit-mode d-none text-center bg-white text-dark time-input" name="fan{{$i}}_on_time" id="fan{{$i}}-on-time-input" style="height: 24px; font-size: 11px; padding: 2px;">
                                        </div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">Off Time</div>
                                        <div class="cc-metric-value -off">
                                            <span class="view-mode" id="fan{{$i}}-off-time">45.0</span>
                                            <input type="text" class="form-control form-control-sm edit-mode d-none text-center bg-white text-dark time-input" name="fan{{$i}}_off_time" id="fan{{$i}}-off-time-input" style="height: 24px; font-size: 11px; padding: 2px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor

                            <!-- Cool 1 -->
                            <div class="cc-device-card">
                                <div class="cc-device-head">
                                    <p class="cc-device-name">Cool 1</p>
                                    <div class="cc-status-chips">
                                        <span class="badge badge-success cc-chip -on">On</span>
                                        <span class="badge badge-danger cc-chip -off">Off</span>
                                    </div>
                                </div>
                                <div class="cc-device-body">
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">On Temp</div>
                                        <div class="cc-metric-value -on">
                                            <span class="view-mode" id="cool1-on-temp">45.0</span>
                                            <input type="text" class="form-control form-control-sm edit-mode d-none text-center bg-white text-dark temp-input" name="pad1_on_temp" id="cool1-on-temp-input" style="height: 24px; font-size: 11px; padding: 2px;">
                                        </div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">Off Temp</div>
                                        <div class="cc-metric-value -off">
                                            <span class="view-mode" id="cool1-off-temp">45.0</span>
                                            <input type="text" class="form-control form-control-sm edit-mode d-none text-center bg-white text-dark temp-input" name="pad1_off_temp" id="cool1-off-temp-input" style="height: 24px; font-size: 11px; padding: 2px;">
                                        </div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">On Time</div>
                                        <div class="cc-metric-value -on">
                                            <span class="view-mode" id="cool1-on-time">45.0</span>
                                            <input type="text" class="form-control form-control-sm edit-mode d-none text-center bg-white text-dark time-input" name="pad1_on_time" id="cool1-on-time-input" style="height: 24px; font-size: 11px; padding: 2px;">
                                        </div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">Off Time</div>
                                        <div class="cc-metric-value -off">
                                            <span class="view-mode" id="cool1-off-time">45.0</span>
                                            <input type="text" class="form-control form-control-sm edit-mode d-none text-center bg-white text-dark time-input" name="pad1_off_time" id="cool1-off-time-input" style="height: 24px; font-size: 11px; padding: 2px;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Cool 2 -->
                            <div class="cc-device-card">
                                <div class="cc-device-head">
                                    <p class="cc-device-name">Cool 2</p>
                                    <div class="cc-status-chips">
                                        <span class="badge badge-success cc-chip -on">On</span>
                                        <span class="badge badge-danger cc-chip -off">Off</span>
                                    </div>
                                </div>
                                <div class="cc-device-body">
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">On Temp</div>
                                        <div class="cc-metric-value -on">
                                            <span class="view-mode" id="cool2-on-temp">45.0</span>
                                            <input type="text" class="form-control form-control-sm edit-mode d-none text-center bg-white text-dark temp-input" name="pad2_on_temp" id="cool2-on-temp-input" style="height: 24px; font-size: 11px; padding: 2px;">
                                        </div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">Off Temp</div>
                                        <div class="cc-metric-value -off">
                                            <span class="view-mode" id="cool2-off-temp">45.0</span>
                                            <input type="text" class="form-control form-control-sm edit-mode d-none text-center bg-white text-dark temp-input" name="pad2_off_temp" id="cool2-off-temp-input" style="height: 24px; font-size: 11px; padding: 2px;">
                                        </div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">On Time</div>
                                        <div class="cc-metric-value -on">
                                            <span class="view-mode" id="cool2-on-time">45.0</span>
                                            <input type="text" class="form-control form-control-sm edit-mode d-none text-center bg-white text-dark time-input" name="pad2_on_time" id="cool2-on-time-input" style="height: 24px; font-size: 11px; padding: 2px;">
                                        </div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">Off Time</div>
                                        <div class="cc-metric-value -off">
                                            <span class="view-mode" id="cool2-off-time">45.0</span>
                                            <input type="text" class="form-control form-control-sm edit-mode d-none text-center bg-white text-dark time-input" name="pad2_off_time" id="cool2-off-time-input" style="height: 24px; font-size: 11px; padding: 2px;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Heater -->
                            <div class="cc-device-card">
                                <div class="cc-device-head">
                                    <p class="cc-device-name">Heater</p>
                                    <div class="cc-status-chips">
                                        <span class="badge badge-success cc-chip -on">On</span>
                                        <span class="badge badge-danger cc-chip -off">Off</span>
                                    </div>
                                </div>
                                <div class="cc-device-body">
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">On Temp</div>
                                        <div class="cc-metric-value -on">
                                            <span class="view-mode" id="heater-on-temp">45.0</span>
                                            <input type="text" class="form-control form-control-sm edit-mode d-none text-center bg-white text-dark temp-input" name="heat_on_temp" id="heater-on-temp-input" style="height: 24px; font-size: 11px; padding: 2px;">
                                        </div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">Off Temp</div>
                                        <div class="cc-metric-value -off">
                                            <span class="view-mode" id="heater-off-temp">45.0</span>
                                            <input type="text" class="form-control form-control-sm edit-mode d-none text-center bg-white text-dark temp-input" name="heat_off_temp" id="heater-off-temp-input" style="height: 24px; font-size: 11px; padding: 2px;">
                                        </div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">On Time</div>
                                        <div class="cc-metric-value -on">
                                            <span class="view-mode" id="heater-on-time">45.0</span>
                                            <input type="text" class="form-control form-control-sm edit-mode d-none text-center bg-white text-dark time-input" name="heat_on_time" id="heater-on-time-input" style="height: 24px; font-size: 11px; padding: 2px;">
                                        </div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">Off Time</div>
                                        <div class="cc-metric-value -off">
                                            <span class="view-mode" id="heater-off-time">45.0</span>
                                            <input type="text" class="form-control form-control-sm edit-mode d-none text-center bg-white text-dark time-input" name="heat_off_time" id="heater-off-time-input" style="height: 24px; font-size: 11px; padding: 2px;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Light -->
                            <div class="cc-device-card">
                                <div class="cc-device-head">
                                    <p class="cc-device-name">Light</p>
                                    <div class="cc-status-chips">
                                        <span class="badge badge-success cc-chip -on">On</span>
                                        <span class="badge badge-danger cc-chip -off">Off</span>
                                    </div>
                                </div>
                                <div class="cc-device-body">
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">On Temp</div>
                                        <div class="cc-metric-value -on">45.0</div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">Off Temp</div>
                                        <div class="cc-metric-value -off">45.0</div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">On Time</div>
                                        <div class="cc-metric-value -on">45.0</div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">Off Time</div>
                                        <div class="cc-metric-value -off">45.0</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- wide extras -->
                        <div class="cc-device-grid -wide mt-3">
                            <div class="cc-device-card">
                                <div class="cc-device-head">
                                    <p class="cc-device-name">Extra 1</p>
                                    <div class="cc-status-chips">
                                        <span class="badge badge-success cc-chip -on">On</span>
                                        <span class="badge badge-danger cc-chip -off">Off</span>
                                    </div>
                                </div>
                                <div class="cc-device-body">
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">On Temp</div>
                                        <div class="cc-metric-value -on">45.0</div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">Off Temp</div>
                                        <div class="cc-metric-value -off">45.0</div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">On Time</div>
                                        <div class="cc-metric-value -on">45.0</div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">Off Time</div>
                                        <div class="cc-metric-value -off">45.0</div>
                                    </div>
                                </div>
                            </div>

                            <div class="cc-device-card">
                                <div class="cc-device-head">
                                    <p class="cc-device-name">Extra 2</p>
                                    <div class="cc-status-chips">
                                        <span class="badge badge-success cc-chip -on">On</span>
                                        <span class="badge badge-danger cc-chip -off">Off</span>
                                    </div>
                                </div>
                                <div class="cc-device-body">
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">On Temp</div>
                                        <div class="cc-metric-value -on">45.0</div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">Off Temp</div>
                                        <div class="cc-metric-value -off">45.0</div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">On Time</div>
                                        <div class="cc-metric-value -on">45.0</div>
                                    </div>
                                    <div class="cc-metric-row">
                                        <div class="cc-metric-label">Off Time</div>
                                        <div class="cc-metric-value -off">45.0</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- actions -->
                        <div class="cc-actions">
                            <button type="button" id="btn-edit" class="cc-btn -primary">Edit</button>
                            <button type="submit" id="btn-save" class="cc-btn -success d-none">Save</button>
                            <button type="button" id="btn-cancel" class="cc-btn -secondary d-none">Cancel</button>
                            <a href="" id="myEdit" class="cc-btn -primary d-none">Edit</a>
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
        var isEditing = false;
        window.currentData = null;

        function formatTemp(val) {
            if (val === null || val === undefined || val === '') return '';
            var num = parseFloat(val);
            if (isNaN(num)) return val;
            return (num / 10).toFixed(1);
        }

        function formatTime(val) {
            if (val === null || val === undefined || val === '') return '';
            return val + ' sec';
        }

        // Fetch data initially
        fetchData();
        // Set interval to fetch data every 10 seconds
        setInterval(function() {
            if (!isEditing) {
                fetchData();
            }
        }, 10000);  

        function fetchData() {
            $.ajax({
                url: "{{ route('fetch.data') }}",
                type: "GET",
                success: function(response) {
                    window.currentData = response.data;
                    updateUI();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        function updateUI() {
            if (!window.currentData) return;
            var data = window.currentData;

            $('#room_temp').text(formatTemp(data.temperature));
            $('#brooder_temp').text(formatTemp(data.temp2_brooder));
            $('#outside_temp').text(formatTemp(data.temp3_outside));
            $('#humidity').text(data.humidity);

            @for($i=1;$i<=12;$i++)
            $('#fan{{$i}}-on-temp').text(formatTemp(data.fan{{$i}}_on_temp));
            $('#fan{{$i}}-off-temp').text(formatTemp(data.fan{{$i}}_off_temp));
            $('#fan{{$i}}-on-time').text(formatTime(data.fan{{$i}}_on_time));
            $('#fan{{$i}}-off-time').text(formatTime(data.fan{{$i}}_off_time));
            @endfor

            // cool1
            $('#cool1-on-temp').text(formatTemp(data.pad1_on_temp));
            $('#cool1-off-temp').text(formatTemp(data.pad1_off_temp));
            $('#cool1-on-time').text(formatTime(data.pad1_on_time));
            $('#cool1-off-time').text(formatTime(data.pad1_off_time));

            // cool2
            $('#cool2-on-temp').text(formatTemp(data.pad2_on_temp));
            $('#cool2-off-temp').text(formatTemp(data.pad2_off_temp));
            $('#cool2-on-time').text(formatTime(data.pad2_on_time));
            $('#cool2-off-time').text(formatTime(data.pad2_off_time));

            // heat
            $('#heater-on-temp').text(formatTemp(data.heat_on_temp));
            $('#heater-off-temp').text(formatTemp(data.heat_off_temp));
            $('#heater-on-time').text(formatTime(data.heat_on_time));
            $('#heater-off-time').text(formatTime(data.heat_off_time));

            var id = data.device_id;
            var newURL = `/cm-shed1/${id}/edit`;
            $("#myEdit").prop('href', newURL);
            $('#inline-edit-form').attr('action', `/cm-shed1/${id}`);
        }

        function populateInputs() {
            if (!window.currentData) return;
            var data = window.currentData;

            @for($i=1;$i<=12;$i++)
            $('#fan{{$i}}-on-temp-input').val(data.fan{{$i}}_on_temp ?? '');
            $('#fan{{$i}}-off-temp-input').val(data.fan{{$i}}_off_temp ?? '');
            $('#fan{{$i}}-on-time-input').val(data.fan{{$i}}_on_time || '');
            $('#fan{{$i}}-off-time-input').val(data.fan{{$i}}_off_time || '');
            @endfor

            // cool1
            $('#cool1-on-temp-input').val(data.pad1_on_temp ?? '');
            $('#cool1-off-temp-input').val(data.pad1_off_temp ?? '');
            $('#cool1-on-time-input').val(data.pad1_on_time || '');
            $('#cool1-off-time-input').val(data.pad1_off_time || '');

            // cool2
            $('#cool2-on-temp-input').val(data.pad2_on_temp ?? '');
            $('#cool2-off-temp-input').val(data.pad2_off_temp ?? '');
            $('#cool2-on-time-input').val(data.pad2_on_time || '');
            $('#cool2-off-time-input').val(data.pad2_off_time || '');

            // heat
            $('#heater-on-temp-input').val(data.heat_on_temp ?? '');
            $('#heater-off-temp-input').val(data.heat_off_temp ?? '');
            $('#heater-on-time-input').val(data.heat_on_time || '');
            $('#heater-off-time-input').val(data.heat_off_time || '');

        }

        $('#btn-edit').on('click', function() {
            isEditing = true;
            populateInputs();
            $('.view-mode').addClass('d-none');
            $('.edit-mode').removeClass('d-none');
            $('#btn-edit').addClass('d-none');
            $('#btn-save, #btn-cancel').removeClass('d-none');
        });

        $('#btn-cancel').on('click', function() {
            isEditing = false;
            $('.view-mode').removeClass('d-none');
            $('.edit-mode').addClass('d-none');
            $('#btn-edit').removeClass('d-none');
            $('#btn-save, #btn-cancel').addClass('d-none');
            updateUI();
        });

        $('#inline-edit-form').on('submit', function() {
            // Temp inputs already hold raw controller values — no scaling needed
        });
    });
</script>
@endsection