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
                                        <li class="breadcrumb-item"><a href="/shed1">Assets</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                                    </ol>
                                </nav>
                            </div>
                            <!-- /BREADCRUMB -->
                <!-- Edit form start -->
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
                                    <h4>Edit Data</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="{{ route('shed1.update', $data->id) }}" class="m-3 p-3" method="POST">
                                @csrf
                                @method('PUT') <!-- Use PUT method for updating -->
                                <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="day_feed">Day Feed</label>
                                        <input type="text" class="form-control" name="day_feed" id="day_feed" value="{{ $data->day_feed }}" placeholder="Enter Day Feed">
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="night_feed">Night Feed</label>
                                        <input type="text" class="form-control" name="night_feed" id="night_feed" value="{{ $data->night_feed }}" placeholder="Enter Night Feed">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="day_mor">Day Mortality</label>
                                        <input type="text" class="form-control" name="day_mor" id="day_mor" value="{{ $data->day_mor }}" placeholder="Enter Day Mortality">
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="night_mor">Night Mortality</label>
                                        <input type="text" class="form-control" name="night_mor" id="night_mor" value="{{ $data->night_mor }}" placeholder="Enter Night Mortality">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Weight</label>
                                        <input type="text" class="form-control" name="weight" id="name" value="{{ $data->weight }}" placeholder="Enter Weight(Kg)">
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Water Intake</label>
                                        <input type="text" class="form-control" name="water_intake" id="name" value="{{ $data->water_intake }}" placeholder="Enter ">
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Age</label>
                                        <input type="text" class="form-control" name="age" id="name" value="{{ $data->age }}" placeholder="Enter Weight(g)">
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="plan_factor">Feed Factor</label>
                                        <input type="text" class="form-control" name="plan_factor" value="{{ $data->plan_factor }}" id="plan_factor"  placeholder="Feed Factor">
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Feed Received</label>
                                        <input type="text" class="form-control" name="feed_recieved" id="name" value="{{ $data->feed_recieved }}" placeholder="Enter Feed">
                                    </div>
                                    </div>
                                <!-- Add other fields here -->
                                <div class="form-group col-6 mb-2">
                                    <input type="submit" value="Update" class="btn btn-primary m-3">
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
