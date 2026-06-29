@extends('layout.layout')
 @section('content')
<div class="layout-px-spacing">

    <div class="middle-content container-xxl p-0">

        <div class="row layout-top-spacing">

            <div class="middle-content container-xxl p-0">
                <!--- registration form start --->
                <div class="col-lg-12 col-12  layout-spacing">

                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Add New</h4>
                                </div>
                            </div>
                        </div>

                        <div class="widget-content widget-content-area">
                            <form action="{{ route('management.store') }}" class="m-3 p-3" method="POST">
                                @csrf
                                  
                           
                                   
                                    <div class="row">
                                      <div class="form-group col-6 mb-2">
                                        <label for="age">Age</label>
                                        <input type="number" class="form-control" name="age" id="age" value="{{ old('age') }}" placeholder="Enter Age">
                                      </div>
                                      <div class="form-group col-6 mb-2">
                                        <label for="temperature">Temperature </label>
                                        <input type="number" class="form-control" name="temperature" id="temperature" value="{{ old('temperature') }}" placeholder="Enter Temperature">
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-6 mb-2">
                                        <label for="vent_opening">Vent Opening</label>
                                        <input type="number" class="form-control" name="vent_opening" id="vent_opening" value="{{ old('vent_opening') }}" placeholder="Enter Vent Opening">
                                      </div>
                                      <div class="form-group col-6 mb-2">
                                        <label for="vents">No Of Vents</label>
                                        <input type="number" class="form-control" name="brooding_vents" id="vents" value="{{ old('vents') }}" placeholder="Enter No Of Vents">
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-6 mb-2">
                                        <label for="feeders">Feeders</label>
                                        <input type="number" class="form-control" name="feeders" id="feeders" value="{{ old('feeders') }}" placeholder="EnterFeeders">
                                      </div>
                                      <div class="form-group col-6 mb-2">
                                        <label for="cfm">CFM</label>
                                        <input type="text" class="form-control" name="cfm" id="cfm" value="{{ old('cfm') }}" placeholder="Enter CFM">
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-6 mb-2">
                                        <label for="pad_length">Pad Length</label>
                                        <input type="number" class="form-control" name="pad_length" id="pad_length" value="{{ old('pad_length') }}" placeholder="Enter Pad Length">
                                      </div>
                                      <div class="form-group col-6 mb-2">
                                        <label for="pad_opening">Pad Opening</label>
                                        <input type="number" class="form-control" name="pad_opening" id="pad_opening" value="{{ old('pad_opening') }}" placeholder="Enter Pad Opening">
                                      </div>
                                    </div>


                                    <div class="row">
                                      <?php for($i=1;$i<11;$i++){?>
                                      <div class="form-group col-6 mb-2">
                                        <label for="fan_<?php echo $i;?>_on_t">Fan <?php echo $i;?> On Time</label>
                                        <input type="time" class="form-control" name="fan_<?php echo $i;?>_on_t" id="fan_<?php echo $i;?>_on_t" value="{{ old('fan_<?php echo $i;?>_on_t') }}" placeholder="Fan <?php echo $i;?> On Time">
                                      </div>
                                      <div class="form-group col-6 mb-2">
                                        <label for="fan_<?php echo $i;?>_off_t">Fan <?php echo $i;?> Off Time </label>
                                        <input type="time" class="form-control" name="fan_<?php echo $i;?>_off_t" id="fan_<?php echo $i;?>_off_t" value="{{ old('fan_<?php echo $i;?>_off_t') }}" placeholder="Fan <?php echo $i;?> Off Time">
                                      </div>
                                      <?php }?>
                                    </div>
                                   

                                    <div class="form-group col-6 mb-2">
                                        <input type="submit" name="" value="Save" class="btn btn-primary m-3" id="">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--- registration form end --->
            </div>
            <!--- main divs ending start --->
        </div>
    </div>
</div>

@endsection
