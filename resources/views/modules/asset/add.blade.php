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
                                        <li class="breadcrumb-item"><a href="/asset">Assets</a></li>
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
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Add</h4>
                                </div>
                            </div>
                        </div>

                        <div class="widget-content widget-content-area">
                            <form action="{{ route('asset.store') }}" class="m-3 p-3" method="POST">
                                @csrf
                                   <div class="row">
                                  
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Title</label>
                                        <input type="text" required class="form-control" name="title" id="name" value="{{ old('title') }}" placeholder="Enter Title">
                                    </div>
                                    
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Description</label>
                                        <input type="text"  class="form-control" name="desc" id="name" value="{{ old('desc') }}" placeholder="Enter Description">
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Type</label>
                                        <select name="type" class="form-control" id="">
                                            <option value="">Select Type</option>
                                            <option value="Diesel">Diesel</option>
                                            <option value="Wood">Wood</option>
                                        </select>
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
