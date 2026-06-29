@extends('layout.layout')
@section('content')
<div class="layout-px-spacing">
    <div class="middle-content container-xxl p-0">
        <div class="row layout-top-spacing">
            <div class="middle-content container-xxl p-0">
                <!-- Edit form start -->
                <div class="col-lg-12 col-12  layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Edit Data</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="{{ route('farm.update', $data->id) }}" class="m-3 p-3" method="POST">
                                @csrf
                                @method('PUT') <!-- Use PUT method for updating -->
                                <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Farm Name</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $data->name }}" placeholder="Enter Name">
                                       
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Address</label>
                                        <input type="text" class="form-control" name="address" id="name" value="{{ $data->address }}" placeholder="Enter Address">
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Contact</label>
                                        <input type="text" class="form-control" name="contact" id="name" value="{{ $data->contact }}" placeholder="Enter Contact">
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                    <label for="name">Select Session</label>

                                    <select class="form-control"  name="active_session" id="">
                                            <option value="">Select Active Session</option>
                                            @foreach($sess as $med)
                                              <option value="{{$med->id}}" <?php if($med->id==$data->active_session){ echo 'selected';}?>>{{$med->starting_date}} to {{$med->ending_date}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-6 mb-2">
                                        <label for="shed_length">Length of Shed</label>
                                        <input type="text" class="form-control" value="{{ $data->shed_length }}" name="shed_length" id="shed_length" value="{{ old('shed_length') }}" placeholder="Enter Length of shed">
                                      </div>
                                      <div class="form-group col-6 mb-2">
                                        <label for="shed_height">Height of Shed</label>
                                        <input type="text" class="form-control" value="{{ $data->shed_height }}" name="shed_height" id="shed_height" value="{{ old('shed_height') }}" placeholder="Enter Height of shed">
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-6 mb-2">
                                        <label for="shed_width">Width of Shed</label>
                                        <input type="text" class="form-control" value="{{ $data->shed_width }}" name="shed_width" id="shed_width" value="{{ old('shed_width') }}" placeholder="Enter Width of shed">
                                      </div>
                                      <div class="form-group col-6 mb-2">
                                        <label for="fan_capacity">Fan Capacity</label>
                                        <input type="text" class="form-control" value="{{ $data->fan_capacity }}" name="fan_capacity" id="fan_capacity" value="{{ old('fan_capacity') }}" placeholder="Enter Fan Capacity">
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-6 mb-2">
                                        <label for="no_of_vents">No of Vents installed</label>
                                        <input type="text" class="form-control" value="{{ $data->no_of_vents }}" name="no_of_vents" id="no_of_vents" value="{{ old('no_of_vents') }}" placeholder="Enter No of Vents installed">
                                      </div>
                                      <div class="form-group col-6 mb-2">
                                        <label for="length_of_vent">Length of Vent</label>
                                        <input type="text" class="form-control" value="{{ $data->length_of_vent }}" name="length_of_vent" id="length_of_vent" value="{{ old('length_of_vent') }}" placeholder="Enter Length of Vent">
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
                <!-- Edit form end -->
            </div>
        </div>
    </div>
</div>
@endsection
