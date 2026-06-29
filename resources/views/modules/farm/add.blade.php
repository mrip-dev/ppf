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
                                    <h4>Add New Farm</h4>
                                </div>
                            </div>
                        </div>

                        <div class="widget-content widget-content-area">
                            <form action="{{ route('farm.store') }}" class="m-3 p-3" method="POST">
                                @csrf
                                   <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Farm Name</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Enter Name">
                                       
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Address</label>
                                        <input type="text" class="form-control" name="address" id="name" value="{{ old('name') }}" placeholder="Enter Address">
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="company_name">Company</label>
                                        <input type="text" class="form-control" name="company_name" id="company_name" value="{{ old('company_name') }}" placeholder="Company Name">
                                      </div>
                                    
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Active Session</label>
                                        <select class="form-control"  name="active_session" id="">
                                            <option value="">Select Active Session</option>
                                            @foreach($sess as $med)
                                              <option value="{{$med->id}}">{{$med->starting_date}} to {{$med->ending_date}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>

                                    <div class="row">
                                      <div class="form-group col-6 mb-2">
                                        <label for="shed_length">Length of Shed</label>
                                        <input type="text" class="form-control" name="shed_length" id="shed_length" value="{{ old('shed_length') }}" placeholder="Enter Length of shed">
                                      </div>
                                      <div class="form-group col-6 mb-2">
                                        <label for="shed_height">Height of Shed</label>
                                        <input type="text" class="form-control" name="shed_height" id="shed_height" value="{{ old('shed_height') }}" placeholder="Enter Height of shed">
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-6 mb-2">
                                        <label for="shed_width">Width of Shed</label>
                                        <input type="text" class="form-control" name="shed_width" id="shed_width" value="{{ old('shed_width') }}" placeholder="Enter Width of shed">
                                      </div>
                                      <div class="form-group col-6 mb-2">
                                        <label for="fan_capacity">Fan Capacity</label>
                                        <input type="text" class="form-control" name="fan_capacity" id="fan_capacity" value="{{ old('fan_capacity') }}" placeholder="Enter Fan Capacity">
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-6 mb-2">
                                        <label for="shed_width">Device Id Shed1</label>
                                        <input type="text" class="form-control" name="device_id_shed1" id="device_id_shed1" value="{{ old('device_id_shed1') }}" placeholder="Device Id Shed1">
                                      </div>
                                      <div class="form-group col-6 mb-2">
                                        <label for="fan_capacity">Device Id Shed2</label>
                                        <input type="text" class="form-control" name="device_id_shed2" id="device_id_shed2" value="{{ old('device_id_shed2') }}" placeholder="Device Id Shed2">
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-4 mb-2">
                                        <label for="no_of_vents">No of Vents installed</label>
                                        <input type="text" class="form-control" name="no_of_vents" id="no_of_vents" value="{{ old('no_of_vents') }}" placeholder="Enter No of Vents installed">
                                      </div>
                                      <div class="form-group col-4 mb-2">
                                        <label for="company_name">Length of Vent</label>
                                        <input type="text" class="form-control" name="length_of_vent" id="length_of_vent" value="{{ old('length_of_vent') }}" placeholder="Enter Length of Vent">
                                      </div>
                                      <div class="form-group col-4 mb-2">
                                        <label for="name">Contact</label>
                                        <input type="text" class="form-control" name="contact" id="name" value="{{ old('name') }}" placeholder="Enter Contact">
                                    </div>
                                     
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
