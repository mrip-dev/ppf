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
                                    <h4>Add Flock</h4>
                                </div>
                            </div>
                        </div>

                        <div class="widget-content widget-content-area">
                            <form action="{{ route('session.store') }}" class="m-3 p-3" method="POST">
                                @csrf
                                   <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Hatch Date</label>
                                        <input type="date" class="form-control" name="starting_date" id="name" value="{{ old('name') }}" placeholder="Enter Hatch Date">
                                       
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Ending Date</label>
                                        <input type="date" class="form-control" name="ending_date" id="name" value="{{ old('name') }}" placeholder="Enter Ending Date">
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="form-group col-4 mb-2">
                                        <label for="name">Placement Shed 1</label>
                                        <input type="text" class="form-control" name="str_shed1" id="name" value="{{ old('name') }}" placeholder="Enter Placement Shed 1">
                                    </div>
                                    <div class="form-group col-4 mb-2">
                                        <label for="name">Placement Shed 2</label>
                                        <input type="text" class="form-control" name="str_shed2" id="name" value="{{ old('name') }}" placeholder="Enter Placement Shed 2">
                                    </div>
                                    <div class="form-group col-4 mb-2">
                                        <label for="name">Flock NO.</label>
                                        <input type="text" class="form-control" name="flock_no" id="name" value="{{ old('name') }}" placeholder="Enter Flock">
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
