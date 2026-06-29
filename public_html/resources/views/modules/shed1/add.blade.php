@extends('layout.layout')
 @section('content')
<div class="layout-px-spacing">

    <div class="middle-content container-xxl p-0">

        <div class="row layout-top-spacing">

            <div class="middle-content container-xxl p-0">
                 <!-- BREADCRUMB -->
                 <div class="page-meta">
                                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/shed1">Shed1L</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Create New</li>
                                    </ol>
                                </nav>
                            </div>
                            <!-- /BREADCRUMB -->
                <!--- registration form start --->
                <div class="col-lg-12 col-12  layout-spacing">

                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="text-center col-12">
                                    <h1>{{$farm?->name}}</h1>
                                    <p>{{$farm?->address}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Add</h4>
                                </div>
                            </div>
                        </div>

                        <div class="widget-content widget-content-area">
                            <form action="{{ route('shed1.store') }}" class="m-3 p-3" method="POST">
                                @csrf
                                   <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Day Feed</label>
                                        <input type="text" class="form-control" name="day_feed" id="name" value="{{ old('name') }}" placeholder="Enter Day Feed">
                                        <input type="hidden" class="form-control" name="farm_id" id="name" value="{{$farm?->id}}">
                                        <input type="hidden" class="form-control" name="session_id" id="name" value="{{$farm?->active_session}}">
                                        <input type="hidden" class="form-control" name="date" id="date" value="{{date('Y-m-d')}}">
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Night Feed</label>
                                        <input type="text" class="form-control" name="night_feed" id="name" value="{{ old('name') }}" placeholder="Enter Night Feed">
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Day Mortality</label>
                                        <input type="text" class="form-control" name="day_mor" id="name" value="{{ old('name') }}" placeholder="Enter Day Mortality">
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Night Mortality</label>
                                        <input type="text" class="form-control" name="night_mor" id="name" value="{{ old('name') }}" placeholder="Enter Night Mortality">
                                    </div>
                                    </div>
                                     <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Weight</label>
                                        <input type="text" class="form-control" name="weight" id="name" value="{{ old('weight') }}" placeholder="Enter Weight(g)">
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Water Intake</label>
                                        <input type="text" class="form-control" name="water_intake" id="name" value="{{ old('Water_intake') }}" placeholder="Enter Water Intake(L)">
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Age</label>
                                        <input type="text" class="form-control" name="age" id="name" value="{{ old('weight') }}" placeholder="Enter Age">
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="plan_factor">Feed Factor</label>
                                        <input type="text" class="form-control" name="plan_factor" id="plan_factor" value="{{ old('plan_factor') }}" placeholder="Feed Factor">
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Feed Received</label>
                                        <input type="text" class="form-control" name="feed_recieved" id="name" value="{{ old('feed_recieved') }}" placeholder="Enter Feed">
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
