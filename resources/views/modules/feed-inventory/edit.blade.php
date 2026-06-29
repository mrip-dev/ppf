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
                                        <li class="breadcrumb-item"><a href="/feed-inventory">Feed</a></li>
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
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Edit Data</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="{{ route('feed-inventory.update', $data->id) }}" class="m-3 p-3" method="POST">
                                @csrf
                                @method('PUT') <!-- Use PUT method for updating -->
                                <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Date</label>
                                        <input type="date" required class="form-control" name="date" id="name" value="{{ $data->date }}" placeholder="Enter Date">
                                        <input type="hidden" class="form-control" name="item_type" id="name" value="1">
                                        <input type="hidden" class="form-control" name="title" id="name" value="Feed">
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Amount</label>
                                        <input type="text" required class="form-control" name="feed_recieved" id="name" value="{{ $data->amount }}" placeholder="Enter Amount">
                                    </div>
                                    </div>
                                    <div class="row">

                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Type</label>
                                        <select class="form-control" value="{{ $data->type }}" required name="type" id="">
                                            
                                            <option value="{{ $data->type }}">Received</option>
                                            <!-- <option >Consumed</option> -->
                                        </select>
                                    </div>
                                    <!-- <div class="form-group col-6 mb-2">
                                        <label for="name">Night Mor</label>
                                        <input type="text" class="form-control" name="night_mor" id="name" value="{{ old('name') }}" placeholder="Enter Night Mor">
                                    </div> -->
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
