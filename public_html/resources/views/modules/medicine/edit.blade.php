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
                                        <li class="breadcrumb-item"><a href="/medicine">Medicine</a></li>
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
                            <form action="{{ route('medicine.update', $data->id) }}" class="m-3 p-3" method="POST">
                                @csrf
                                @method('PUT') <!-- Use PUT method for updating -->
                              
                                    <div class="row">

                                  
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Medicine Name</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $data->name }}" >
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
