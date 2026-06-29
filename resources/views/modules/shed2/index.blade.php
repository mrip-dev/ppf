@extends('layout.layout')
 @section('content')


<div class="layout-px-spacing">
	<div class="middle-content container-xxl p-0">
		 <!-- BREADCRUMB -->
         <div class="page-meta">
                                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                     
                                        <li class="breadcrumb-item active" aria-current="page">Shed2R</li>
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
                                <div class="text-center col-12">
                                    <h1>{{$farm?->name}}</h1>
                                    <p>{{$farm?->address}}</p>
                                </div>
                            </div>
            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h2 class="m-3">Shed2R Entries</h2>
                                </div>
                            </div>
            <div class="row">
                    <div class="col text-end">
                        <a href="/shed2/create" class="btn btn-primary">Add New</a>
                    </div>
                </div>
		<table id="zero-config" class="table">
				
             <thead>
            <tr>
                <th>ID</th>
                <th>Day Mortality</th>
                <th>Night Mortality</th>
               
                <th>Day Feed</th>
                <th>Night Feed</th>
              
                <th>Weight(G)</th>
                <th>Age</th>
                <th>Feed Factor</th>
              
                <th>Water Intake</th>
                <th>Feed Received</th>
                
               
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $datas)
                <tr>
        <td>{{$datas->id}}</td>
      
        <td>{{$datas->day_mor}}</td>
        <td>{{$datas->night_mor}}</td>
      
        <td>{{$datas->day_feed}}</td>
        <td>{{$datas->night_feed}}</td>
      
        <td>{{$datas->weight}}</td>
        <td>{{$datas->age}}</td>
        <td>{{number_format($datas->plan_factor,2)}}</td>      
        <td>{{$datas->water_intake}}</td>
        <td>{{$datas->feed_recieved}}</td>

      
                   
                    
        <td>
                        <div class="row">
                            <div class="col">
                            <a href="{{ route('shed2.edit', $datas->id) }}" class="btn btn-primary">Edit</a>
                            </div>
                            <div class="col">
                            <form action="{{ route('shed2.destroy', $datas->id) }}" method="POST">
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

