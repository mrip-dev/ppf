
@extends('layout.layout')

 @section('content')
<div class="layout-px-spacing">

    <div class="middle-content container-xxl p-0">
<!-- BREADCRUMB -->
<div class="page-meta">
                                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/diesel">Users</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Create New</li>
                                    </ol>
                                </nav>
                            </div>
                            <!-- /BREADCRUMB -->
        <div class="row layout-top-spacing">

            <div class="middle-content container-xxl p-0">
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
                            <form action="{{ route('users.store') }}" class="m-3 p-3" method="POST">
                                @csrf
                                   <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Name</label>
                                        <input type="text" required class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Enter Name">

                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Email</label>
                                        <input type="email" required class="form-control" name="email" id="name" value="{{ old('email') }}" placeholder="Enter Email">
                                    </div>
                                    </div>
                                    <div class="row">

                                    <div class="form-group col-6 mb-2">
                                        <label for="name">User Type</label>
                                        <select class="form-control"  name="user_role" id="">
                                            <option  >Select User Type</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Consultant</option>
                                            <option value="3" >Farmer</option>
                                        </select>

                                    </div>
                                   
                                    <div class="form-group col-6 mb-2" id="">
                                    <label for="name">Farm</label>
                                        <select class="form-control" required  name="farm_id" id="">
                                            <option  >Select Farm</option>
                                            @if(auth()->user()->user_role==4)
                                              @foreach($source as $farm)
                                               <option value="{{$farm->id}}">{{$farm->name}}</option>
                                               @endforeach
                                            @else
                                              <option value="{{auth()->user()?->farm_id}}">This Farm</option>
                                                    
                                            @endif

                                        </select>
                                    </div>
                                    </div>
                                    <div class="row " id="">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Password</label>
                                        <input type="text"  class="form-control"  name="password" id="name" value="{{ old('date') }}" placeholder="Enter Password">
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
