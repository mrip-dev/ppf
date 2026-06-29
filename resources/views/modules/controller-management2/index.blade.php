@extends('layout.layout')
@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <div class="col-xl-12 col-lg-12 col-sm-12 table">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            <br />
            @endif
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            <br />
            @endif
            <div class="widget-content widget-content-area br-8 mt-4 "
                style=" background-color: rgb(135, 206, 235)!important">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4 class="text-dark text-center"><b>Online Climate
                                    Control System Shed 2</b></h4>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <!-- cards  -->
                    <div class=" col-4  ">
                        <div class="widget widget-card-five">
                            <div class="widget-content">
                                <div class="account-box">
                                    <div class="info-box">
                                        <div class="icon">
                                        </div>
                                        <div class="balance-info rounded shadow p-3"
                                            style=" background-color:#F2242A!important">
                                            <h6 class="text-light"
                                                style="font-size:42px"><span
                                                    id="room_temp">50</span>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="card-bottom-section">
                                        <p style="font-size:12px">House
                                            Temperature</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- card 2 -->
                    <div class="col-4 ">
                        <div class="widget widget-card-five">
                            <div class="widget-content">
                                <div class="account-box">
                                    <div class="info-box">
                                        <div class="icon">
                                        </div>
                                        <div class="balance-info rounded shadow p-3"
                                            style=" background-color:#F2242A!important">
                                            <h6 class="text-light"
                                                style="font-size:42px" id="brooder_temp">30.5</h6>
                                        </div>
                                    </div>
                                    <div class="card-bottom-section">
                                        <p style="font-size:12px">Brooder
                                            Temperature</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- card 3 -->
                    <div class="col-4">
                        <div class="widget widget-card-fives">
                            <div class="widget-content">
                                <div class="account-box">
                                    <div class="info-box">
                                        <div class="icon">
                                        </div>
                                        <div class="balance-info  rounded shadow p-3"
                                            style=" background-color:#4C9436!important">
                                            <h6 class="text-light"
                                                style="font-size:42px" id="humidity">20</h6>
                                        </div>
                                    </div>
                                    <div class="card-bottom-section">
                                        <p style="font-size:12px" >Humidity</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row 2 -->
                <div class="row ">
                    <!-- cards  -->
                      <div class=" col  ">
                        <div class="widget widget-card-five">
                            <div class="widget-content">
                                <div class="account-box">
                                    <div class="info-box">
                                        <div class="icon">
                                        </div>
                                        <div class="balance-info rounded shadow p-3"
                                            style=" background-color:#F2242A!important">
                                            <h6 class="text-light"
                                                style="font-size:42px"><span
                                                    id="outside_temp">50</span>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="card-bottom-section">
                                        <p style="font-size:12px">Outside
                                            Temperature</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <!-- card 2 -->
                    <div class="col">
                        <div class="widget widget-card-fives">
                            <div class="widget-content">
                                <div class="account-box">
                                    <div class="info-box">
                                        <div class="icon">
                                        </div>
                                        <div class="balance-info  rounded shadow p-3"
                                            style=" background-color:#4C9436!important">
                                            <h6 class="text-light"
                                                style="font-size:42px" id="outside-humi">20</h6>
                                        </div>
                                    </div>
                                    <div class="card-bottom-section">
                                        <p style="font-size:12px">Outside Humidity</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @for($i=1;$i<=12;$i++) <div
                        class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6 ">
                        <div class="widget widget-card-five bg-light">
                            <div class="card-header row col-12">
                                <div class="col-6">
                                    <p>Fan {{$i}}</p>
                                </div>
                                <div class="col-6">
                                    <span class="badge badge-success">On</span>
                                    <span class="badge badge-danger">Off</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6"> On Temp</div>
                                    <div class="col-md-6 bg-success" id="fan{{$i}}-on-temp" >45.0</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"> Off Temp</div>
                                    <div class="col-md-6 bg-danger" id="fan{{$i}}-off-temp">45.0</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"> On Time</div>
                                    <div class="col-md-6 bg-success" id="fan{{$i}}-on-time">45.0</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"> Off Time</div>
                                    <div class="col-md-6 bg-danger" id="fan{{$i}}-off-time">45.0</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">Total</div>
                                    <div class="col-md-6 bg-info">45.0</div>
                                </div>
                            </div>
                        </div>
                </div>
                @endfor
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3  col-6 ">
                    <div class="widget widget-card-five bg-light">
                        <div class="card-header row col-12">
                            <div class="col-6">
                                <p>Cool 1</p>
                            </div>
                            <div class="col-6">
                                <span class="badge badge-success">On</span>
                                <span class="badge badge-danger">Off</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6"> On Temp</div>
                                <div id="cool1-on-temp" class="col-md-6 bg-success">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> Off Temp</div>
                                <div id="cool1-off-temp" class="col-md-6 bg-danger">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> On Time</div>
                                <div id="cool1-on-time" class="col-md-6 bg-success">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> Off Time</div>
                                <div id="cool1-off-time" class="col-md-6 bg-danger">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">Total</div>
                                <div class="col-md-6 bg-info">45.0</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6 ">
                    <div class="widget widget-card-five bg-light">
                        <div class="card-header row col-12">
                            <div class="col-6">
                                <p>Cool 2</p>
                            </div>
                            <div class="col-6">
                                <span class="badge badge-success">On</span>
                                <span class="badge badge-danger">Off</span>
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="row">
                                <div class="col-md-6"> On Temp</div>
                                <div id="cool2-on-temp" class="col-md-6 bg-success">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> Off Temp</div>
                                <div id="cool2-off-temp" class="col-md-6 bg-danger">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> On Time</div>
                                <div id="cool2-on-time" class="col-md-6 bg-success">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> Off Time</div>
                                <div id="cool2-off-time" class="col-md-6 bg-danger">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">Total</div>
                                <div class="col-md-6 bg-info">45.0</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6 ">
                    <div class="widget widget-card-five bg-light">
                        <div class="card-header row col-12">
                            <div class="col-6">
                                <p>Heater</p>
                            </div>
                            <div class="col-6">
                                <span class="badge badge-success">On</span>
                                <span class="badge badge-danger">Off</span>
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="row">
                                <div class="col-md-6"> On Temp</div>
                                <div id="heater-on-temp" class="col-md-6 bg-success">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> Off Temp</div>
                                <div id="heater-off-temp" class="col-md-6 bg-danger">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> On Time</div>
                                <div id="heater-on-time" class="col-md-6 bg-success">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> Off Time</div>
                                <div id="heater-off-time" class="col-md-6 bg-danger">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">Total</div>
                                <div class="col-md-6 bg-info">45.0</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-6 ">
                    <div class="widget widget-card-five bg-light">
                        <div class="card-header row col-12">
                            <div class="col-6">
                                <p>Light</p>
                            </div>
                            <div class="col-6">
                                <span class="badge badge-success">On</span>
                                <span class="badge badge-danger">Off</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6"> On Temp</div>
                                <div class="col-md-6 bg-success">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> Off Temp</div>
                                <div class="col-md-6 bg-danger">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> On Time</div>
                                <div class="col-md-6 bg-success">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> Off Time</div>
                                <div class="col-md-6 bg-danger">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">Total</div>
                                <div class="col-md-6 bg-info">45.0</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                    <div class="widget widget-card-five bg-light">
                        <div class="card-header row col-12">
                            <div class="col-6">
                                <p>Extra 1</p>
                            </div>
                            <div class="col-6">
                                <span class="badge badge-success">On</span>
                                <span class="badge badge-danger">Off</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6"> On Temp</div>
                                <div class="col-md-6 bg-success">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> Off Temp</div>
                                <div class="col-md-6 bg-danger">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> On Time</div>
                                <div class="col-md-6 bg-success">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> Off Time</div>
                                <div class="col-md-6 bg-danger">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">Total</div>
                                <div class="col-md-6 bg-info">45.0</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                    <div class="widget widget-card-five bg-light">
                        <div class="card-header row col-12">
                            <div class="col-6">
                                <p>Extra 2</p>
                            </div>
                            <div class="col-6">
                                <span class="badge badge-success">On</span>
                                <span class="badge badge-danger">Off</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6"> On Temp</div>
                                <div class="col-md-6 bg-success">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> Off Temp</div>
                                <div class="col-md-6 bg-danger">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> On Time</div>
                                <div class="col-md-6 bg-success">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> Off Time</div>
                                <div class="col-md-6 bg-danger">45.0</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">Total</div>
                                <div class="col-md-6 bg-info">45.0</div>
                            </div>
                        </div>
                       
                    </div>
                    
                </div>
                <div class="col">
                            <a href="" id="myEdit" class="btn btn-primary">Edit</a>
                            </div>
            </div>
            <div id="data-container">
                <!-- Data will be displayed here -->
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        // Fetch data initially
        fetchData();
        // Set interval to fetch data every 5 seconds
        setInterval(fetchData, 10000);  
        function fetchData() {
            $.ajax({
                url: "{{ route('fetch.data2') }}",
                type: "GET",
                success: function(response) {
                    $('#room_temp').text(response.data.temperature);
                    $('#brooder_temp').text(response.data.temp2_brooder);
                    $('#outside_temp').text(response.data.temp3_outside);
                    @for($i=1;$i<=12;$i++)
                    $('#fan{{$i}}-on-temp').text(response.data.fan{{$i}}_on_temp);
                    $('#fan{{$i}}-off-temp').text(response.data.fan{{$i}}_off_temp);
                    $('#fan{{$i}}-on-time').text(response.data.fan{{$i}}_on_time);
                    $('#fan{{$i}}-off-time').text(response.data.fan{{$i}}_off_time);
                    @endfor
                    $('#humidity').text(response.data.humidity);
                    // cool1
                    $('#cool1-on-temp').text(response.data.pad1_on_temp);
                    $('#cool1-off-temp').text(response.data.pad1_off_temp);
                    $('#cool1-on-time').text(response.data.pad1_on_time);
                    $('#cool1-off-time').text(response.data.pad1_off_time);
                    // cool2
                    $('#cool2-on-temp').text(response.data.pad2_on_temp);
                    $('#cool2-off-temp').text(response.data.pad2_off_temp);
                    $('#cool2-on-time').text(response.data.pad2_on_time);
                    $('#cool2-off-time').text(response.data.pad2_off_time);
                    // heat
                    $('#heater-on-temp').text(response.data.heat_on_temp);
                    $('#heater-off-temp').text(response.data.heat_off_temp);
                    $('#heater-on-time').text(response.data.heat_on_time);
                    $('#heater-off-time').text(response.data.heat_off_time);
                    var id=response.data.device_id;
                    var newURL=`/cm-shed2/${id}/edit`;
                    $("#myEdit").prop('href', newURL);
                          
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
    });
</script>
@endsection