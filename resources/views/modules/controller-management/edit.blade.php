@extends('layout.layout')
@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <div class="row layout-top-spacing">
            <div class="middle-content container-xxl p-0">
                <!-- Edit form start -->
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Edit Data</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="{{ route('cm-shed1.update', $data->device_id) }}" class="m-3 p-3" method="POST">
                                @csrf
                               
                                @method('PUT') <!-- Use PUT method for updating -->
                              
                                
                                @for($i = 1; $i <= 12; $i++)
                                    <div class="row">
                                        <div class="form-group col-lg-3 col-6 mb-2">
                                            <label for="fan{{ $i }}_on_temp">Fan {{ $i }} On Temperature</label>
                                            <input type="text" class="form-control" name="fan{{ $i }}_on_temp" id="fan{{ $i }}_on_temp" value="{{ $data->{'fan'.$i.'_on_temp'} }}" placeholder="Enter Fan {{ $i }} On Temperature">
                                        </div>
                                        <div class="form-group col-lg-3 col-6 mb-2">
                                            <label for="fan{{ $i }}_off_temp">Fan {{ $i }} Off Temperature</label>
                                            <input type="text" class="form-control" name="fan{{ $i }}_off_temp" id="fan{{ $i }}_off_temp" value="{{ $data->{'fan'.$i.'_off_temp'} }}" placeholder="Enter Fan {{ $i }} Off Temperature">
                                        </div>
                                   
                                        <div class="form-group col-lg-3 col-6 mb-2">
                                            <label for="fan{{ $i }}_on_time">Fan {{ $i }} On Time</label>
                                            <input type="text" class="form-control" name="fan{{ $i }}_on_time" id="fan{{ $i }}_on_time" value="{{ $data->{'fan'.$i.'_on_time'} }}" placeholder="Enter Fan {{ $i }} On Time">
                                        </div>
                                        <div class="form-group col-lg-3 col-6 mb-2">
                                            <label for="fan{{ $i }}_off_time">Fan {{ $i }} Off Time</label>
                                            <input type="text" class="form-control" name="fan{{ $i }}_off_time" id="fan{{ $i }}_off_time" value="{{ $data->{'fan'.$i.'_off_time'} }}" placeholder="Enter Fan {{ $i }} Off Time">
                                        </div>
                                    </div>
                                @endfor
                                <div class="row">
                                        <div class="form-group col-lg-3 col-6 mb-2">
                                            <label for="pad1_on_time">Cool 1 On Time</label>
                                            <input type="text" class="form-control" name="pad1_on_time" id="pad1_on_time" value="{{ $data->pad1_on_time}}" placeholder="Enter Cool 1 On Time">
                                        </div>
                                        <div class="form-group col-lg-3 col-6 mb-2">
                                            <label for="pad1_off_time">Cool 1 Off Time</label>
                                            <input type="text" class="form-control" name="pad1_off_time" id="pad1_off_time" value="{{ $data->pad1_off_time}}" placeholder="Enter Cool 1 Off Time">
                                        </div>
                                       
                                   
                                        <div class="form-group col-lg-3 col-6 mb-2">
                                            <label for="pad2_on_time">Cool 2 On Time</label>
                                            <input type="text" class="form-control" name="pad2_on_time" id="pad2_on_time" value="{{ $data->pad2_on_time}}" placeholder="Enter Cool 2 On Time">
                                        </div>
                                        <div class="form-group col-lg-3 col-6 mb-2">
                                            <label for="pad2_off_time">Cool 2 Off Time</label>
                                            <input type="text" class="form-control" name="pad2_off_time" id="pad2_off_time" value="{{ $data->pad2_off_time}}" placeholder="Enter Cool 2 Off Time">
                                        </div>
                                       
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-3 col-6 mb-2">
                                            <label for="pad1_on_temp">Cool 1 On Temp</label>
                                            <input type="text" class="form-control" name="pad1_on_temp" id="pad1_on_temp" value="{{ $data->pad1_on_temp}}" placeholder="Enter Cool 1 On Temp">
                                        </div>
                                        <div class="form-group col-lg-3 col-6 mb-2">
                                            <label for="pad1_off_temp">Cool 1 Off Temp</label>
                                            <input type="text" class="form-control" name="pad1_off_temp" id="pad1_off_temp" value="{{ $data->pad1_off_temp}}" placeholder="Enter Cool 1 Off Temp">
                                        </div>
                                       
                                  
                                        <div class="form-group col-lg-3 col-6 mb-2">
                                            <label for="pad2_on_temp">Cool 2 On Temp</label>
                                            <input type="text" class="form-control" name="pad2_on_temp" id="pad2_on_temp" value="{{ $data->pad2_on_temp}}" placeholder="Enter Cool 2 On Temp">
                                        </div>
                                        <div class="form-group col-lg-3 col-6 mb-2">
                                            <label for="pad2_off_temp">Cool 2 Off Temp</label>
                                            <input type="text" class="form-control" name="pad2_off_temp" id="pad2_off_temp" value="{{ $data->pad2_off_temp}}" placeholder="Enter Cool 2 Off Temp">
                                        </div>
                                       
                                  
                                        <div class="form-group col-lg-3 col-6 mb-2">
                                            <label for="heat_on_temp">Heater On Temp</label>
                                            <input type="text" class="form-control" name="heat_on_temp" id="heat_on_temp" value="{{ $data->heat_on_temp}}" placeholder="Enter Heater On Temp">
                                        </div>
                                        <div class="form-group col-lg-3 col-6 mb-2">
                                            <label for="heat_off_temp">Heater Off Temp</label>
                                            <input type="text" class="form-control" name="heat_off_temp" id="heat_off_temp" value="{{ $data->heat_off_temp}}" placeholder="Enter Heater Off Temp">
                                            <input type="hidden" class="form-control" name="save" id="" value="1" placeholder="Enter Heater Off Temp">
                                        </div>
                                       
                                    </div>
                                <div class="form-group col-lg-3 col-6 mb-2">
                                    <input type="submit" value="Save" class="btn btn-primary m-3">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Edit form end -->
            </div>
        </div>
    </div>
</div>
@endsection
