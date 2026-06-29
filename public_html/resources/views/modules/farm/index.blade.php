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
           
            <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Protein Farm</h4>
                                </div>
                            </div>
                        </div> <div class="row">
                    
                </div>
		<table id="zero-config" class="table">
				
             <thead>
            <tr>
                <th>ID</th>
                <th>Farm Name</th>
               
                <th>Active Session</th>
               
               
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $datas)
                <tr>
        <td>{{$datas->id}}</td>
        <td>{{$datas->name}}</td>
        
        <td>{{$datas->tender?->starting_date}} to {{$datas->tender?->ending_date}}</td>
       
                   
                    
        <td>
                        <div class="row">
                            <div class="col">
                            <a href="{{ route('farm.edit', $datas->id) }}" class="btn btn-primary">Edit</a>
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

