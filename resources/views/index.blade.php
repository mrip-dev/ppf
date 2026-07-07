@extends('layout.layout')

@section('content')

<?php


$activeflock=App\Http\Controllers\Controller::myFlock();
$dashboard=App\Http\Controllers\Controller::dashboard();
$medicines=App\Http\Controllers\MedicineController::allmeds();


?>

<style>
    /* ===== Modernized Dashboard Styles (visual only) ===== */
    .modern-alert {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        background: linear-gradient(135deg, #fff5f5 0%, #ffe3e3 100%);
        border: 1px solid #ffc9c9;
        border-radius: 14px;
        padding: 18px 22px;
        color: #c92a2a;
        font-weight: 500;
        box-shadow: 0 4px 14px rgba(201, 42, 42, 0.08);
    }

    .modern-alert .btn-primary {
        background: #c92a2a;
        border: none;
        border-radius: 8px;
        padding: 8px 18px;
        font-weight: 600;
        transition: background .2s ease, transform .2s ease;
    }

    .modern-alert .btn-primary:hover {
        background: #a61e1e;
        transform: translateY(-1px);
    }

    .stat-card {
        position: relative;
        background: #ffffff;
        border-radius: 18px;
        padding: 24px;
        height: 100%;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 0, 0, 0.04);
        display: flex;
        align-items: center;
        gap: 18px;
        transition: transform .25s ease, box-shadow .25s ease;
        overflow: hidden;
    }

    .stat-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 6px;
        height: 100%;
        background: var(--accent, #4c6ef5);
        border-radius: 18px 0 0 18px;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1);
    }

    .stat-card .icon-wrap {
        width: 56px;
        height: 56px;
        min-width: 56px;
        border-radius: 14px;
        background: var(--accent-soft, #edf2ff);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-card .icon-wrap img {
        width: 30px;
        height: 30px;
        object-fit: contain;
    }

    .stat-card .balance-info h6 {
        margin: 0 0 6px 0;
        font-size: 13px;
        letter-spacing: .04em;
        text-transform: uppercase;
        color: #868e96;
        font-weight: 600;
    }

    .stat-card .balance-info p {
        margin: 0;
        font-size: 26px;
        font-weight: 700;
        color: #212529;
    }

    .stat-card.feed { --accent: #2f9e44; --accent-soft: #ebfbee; }
    .stat-card.diesel { --accent: #e8590c; --accent-soft: #fff4e6; }
    .stat-card.wood { --accent: #5c5cff; --accent-soft: #eef0ff; }

    .medicine-panel {
        background: #ffffff;
        border-radius: 18px;
        padding: 28px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 0, 0, 0.04);
    }

    .medicine-panel .panel-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        margin-bottom: 22px;
    }

    .medicine-panel .panel-header .icon-wrap {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: #edf2ff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .medicine-panel .panel-header .icon-wrap img {
        width: 34px;
        height: 34px;
        object-fit: contain;
    }

    .medicine-panel .panel-header h2 {
        font-size: 20px;
        font-weight: 700;
        color: #212529;
        margin: 0;
    }

    #zero-config.table {
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }

    #zero-config.table thead th {
        background: #f8f9fb;
        color: #495057;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .05em;
        font-weight: 700;
        border: none;
        padding: 14px 16px;
    }

    #zero-config.table thead th:first-child { border-radius: 10px 0 0 10px; }
    #zero-config.table thead th:last-child { border-radius: 0 10px 10px 0; }

    #zero-config.table tbody td {
        padding: 14px 16px;
        border-bottom: 1px solid #f1f3f5;
        color: #343a40;
        font-size: 14.5px;
        vertical-align: middle;
    }

    #zero-config.table tbody tr:hover {
        background: #f8f9fb;
    }

    #zero-config.table tbody tr:last-child td {
        border-bottom: none;
    }
</style>

            @if(!$activeflock)
              <div class="col-12 layout-spacing p-4 m-4">
                <div class="modern-alert">
                  <span>&#9888;&nbsp; Flock is not activated yet!</span>
                  <a href="{{ route('farm.edit', auth()->user()->farm_id) }}" class="btn btn-primary">Please activate Flock</a>
                </div>
              </div>
              @endif

                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="stat-card feed">
                                <div class="icon-wrap">
                                    <img src="images/feed.png" alt="money-bag">
                                </div>
                                <div class="balance-info">
                                    <h6>Available Feed</h6>
                                    <p>{{$dashboard['Feed']}} <span style="font-size:15px; font-weight:600; color:#868e96;">Bags</span></p>
                                </div>
                            </div>
                        </div>
                        <!-- card one end  -->
                         <!-- Card two start -->
                         <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="stat-card diesel">
                                <div class="icon-wrap">
                                    <img src="images/diesel.png" alt="money-bag">
                                </div>
                                <div class="balance-info">
                                    <h6>Available Diesel</h6>
                                    <p>{{$dashboard['diesel']}} <span style="font-size:15px; font-weight:600; color:#868e96;">Litres</span></p>
                                </div>
                            </div>
                        </div>
                        <!-- card two end  -->

                            <!-- Card four start -->
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="stat-card wood">
                                <div class="icon-wrap">
                                    <img src="images/wood.png" alt="money-bag">
                                </div>
                                <div class="balance-info">
                                    <h6>Available Wood</h6>
                                    <p>{{$dashboard['wood']}}</p>
                                </div>
                            </div>
                        </div>
                        <!-- card three end  -->

 <!-- Card three start -->
                         <div class="col-12 layout-spacing">
                            <div class="medicine-panel">
                                <div class="panel-header">
                                    <div class="icon-wrap">
                                        <img src="images/med.png" alt="money-bag">
                                    </div>
                                    <h2>Medicine Summary</h2>
                                </div>

                                <div class="table-responsive">
                                <table id="zero-config" class="table">

                <thead>
               <tr>
                   <th>ID</th>
                   <th>Medicine Name</th>
                   <th>Received</th>
                   <th>Consumed</th>
                   <th>Stock</th>

               </tr>
           </thead>
           <tbody>
                  @foreach($medicines as $medi)
                   <tr>
                      <td>{{$medi->id}}</td>
                      <td>{{$medi->name}}</td>
                      <?php
                         $medicine=App\Http\Controllers\Controller::getMedicine($medi->id);
                      ?>
                      <td>{{$medicine['mediciner']}}</td>
                      <td>{{$medicine['medicinec']}}</td>
                      <td>{{$medicine['medicine']}}</td>

                   </tr>
                   @endforeach
           </tbody>

       </table>
                                </div>
                            </div>
                        </div>
                        <!-- card three end  -->

@endsection