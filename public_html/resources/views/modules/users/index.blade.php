@extends('layout.layout')
 @section('content')


 <div class="layout-px-spacing">
	<div class="middle-content container-xxl p-0">
        
		<!-- BREADCRUMB -->
        <div class="page-meta">
                                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/users">Users</a></li>

                                    </ol>
                                </nav>
                            </div>
                            <!-- /BREADCRUMB -->
		<div class="col-xl-12 col-lg-12 col-sm-12 table">
        
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        <br />
        @endif
         @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        <br />
        @endif
			<div class="widget-content widget-content-area br-8 mt-4">
            <div class="row">
                    <div class="col text-end">
                        <a href="/users/create" class="btn btn-primary">Add New</a>
                    </div>
                </div>
		<table id="zero-config" class="table">
				
             <thead>
            <tr>
                <th>ID</th>
               
                <th>Name</th>
                <th>Email</th>                  
                <th>User Type</th>
                @if(auth()->user()->user_role==4)
                <th>Password</th>
                @endif
                <th>Actions</th>
                
                
              
               
            </tr>
        </thead>
        <tbody>
       <?php $u_type='Farmer'; ?>
        @foreach($data as $datas)
                <tr>
        <td>{{$datas->id}}</td>
        <td>{{$datas->name}}</td>
        <td>{{$datas->email}}</td>
        <?php
        if($datas->user_role){
            if($datas->user_role==1){
                $u_type='Admin';
            }elseif($datas->user_role==2){
               $u_type='Consultant';
            }
        elseif($datas->user_role==4){
            $u_type='Super Admin';
         }}
        
        ?>
        <td>{{$u_type}}</td>
        @if(auth()->user()->user_role==4)
        <td>{{$datas->str_password}}</td>
        @endif
        
       
        
        
 
       
       
                   
                    
        <td>
                        <div class="row">
                            <div class="col">
                            <a href="{{ route('users.edit', $datas->id) }}" class="btn btn-primary">Edit</a>
                            </div>
                            <div class="col">
                            <form action="{{ route('users.destroy', $datas->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                            </div>
                        </div>
                        
                       
                    </td>
                  
                </tr>
                @endforeach
        </tbody>
       
    </table>
   
			</div>
		</div>
	</div>
</div>

@endsection

