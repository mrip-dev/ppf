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
                                        <li class="breadcrumb-item"><a href="/users">Users</a></li>
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
                            <form action="{{ route('users.update', $data->id) }}" class="m-3 p-3" method="POST">
                                @csrf
                                @method('PUT') <!-- Use PUT method for updating -->
                                <div class="row">
                                <div class="form-group col-6 mb-2">
                                        <label for="name">Name</label>
                                        <input type="text" required class="form-control" name="name" id="name" value="{{ $data->name }}" placeholder="Enter Name">
                                        <input type="hidden" class="form-control" name="item_type" id="name" value="1">
                                        <input type="hidden" class="form-control" name="title" id="name" value="Diesel">

                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Email</label>
                                        <input type="email" required class="form-control" name="email" id="name" value="{{  $data->email }}" placeholder="Enter Email">
                                    </div>
                                    </div>
                                    <div class="row">

                                    <div class="form-group col-6 mb-2">
                                        <label for="name">User Type</label>
                                        <select class="form-control"  value="{{ $data->user_role }}" required name="type" id="">
                                            <option value="" >Select type</option>
                                            <option <?php if($data->user_role==1){ echo 'selected';}?>>Admin</option>
                                            <option <?php if($data->user_role==2){ echo 'selected';}?>>Consultant</option>
                                            <option <?php if($data->user_role==3){ echo 'selected';}?>>Farmer</option>
                                        </select>
                                    </div>
                                  
                                   
                                    </div>
                                    <div class="row d-none" id="consumed_amount2">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Password</label>
                                        <input type="text"  class="form-control"  name="password" id="name" value="{{ $data->password }}" placeholder="Enter Password">
                                    </div>
                                    <!-- <div class="form-group col-6 mb-2">
                                        <label for="name">Load (Amp)</label>
                                        <input type="number" value="{{$data->load}}"    name="load" id="name" class="form-control" value="{{ old('amount') }}" placeholder="Enter Load">
                                    </div> -->
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
