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
                                    <h4>Add Standard</h4>
                                </div>
                            </div>
                        </div>

                        <div class="widget-content widget-content-area">
                            <form action="{{ route('flock-standard.store') }}" class="m-3 p-3" method="POST">
                                @csrf
                                  
                                  
                                 
                                    
                                    <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Day</label>
                                        <input type="text" required class="form-control" name="day" id="name" value="{{ old('day') }}" placeholder="Enter Day">
                                    </div>
                                    
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Feed Amount(g)</label>
                                        <input type="text" required class="form-control" name="feed" id="name" value="{{ old('feed') }}" placeholder="Enter Feed Amount">
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
