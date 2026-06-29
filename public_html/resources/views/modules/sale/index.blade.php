@extends('layout.layout')
 @section('content')


<div class="layout-px-spacing">
	<div class="middle-content container-xxl p-0">
		
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
                                <div class="text-center col-12">
                                    <h1>{{$farm?->name}}</h1>
                                    <p>{{$farm?->address}}</p>
                                </div>
                            </div>
            <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Gate Passes</h4>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                    <div class="col text-end">
                        <a href="/sale/create" class="btn btn-primary">Add New</a>
                    </div>
                </div>
		<table id="zero-config" class="table">
				
             <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
               
                <th>Doc No</th>
                <th>Type</th>
                <th>View</th>
             
               
               
               
               
            </tr>
        </thead>
        <tbody>
        @foreach($data as $datas)
                <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$datas->created_at}}</td>
        <td>{{$datas->id}}</td>
        <td>{{$datas->type}}</td>
        <td>
            <a href="/all-sales/{{$datas->id}}/{{$datas->type}}" class="btn btn-secondary">View</a>
            <a href="/print/{{$datas->id}}/{{$datas->type}}" class="btn btn-success">Print</a>
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

