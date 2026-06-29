@extends('layout.layout')
 @section('content')


<div class="layout-px-spacing">
	<div class="middle-content container-xxl p-0">
		<!-- BREADCRUMB -->
        <div class="page-meta">
                                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/medicine-inventory">Medicine Report</a></li>

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
                        <a href="/medicine-inventory/create" class="btn btn-primary">Add New</a>
                    </div>
                </div>
		<table id="zero-config" class="table">
				
             <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Date</th>
                <th>Amount Shed 1L</th>
                <th>Amount Shed 2R</th>
                <th>Amount</th>
                <th>Type</th>
               
                
              
               
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $datas)
                <tr>
        <td>{{$datas->id}}</td>
        <td>{{$datas->medicine->name}}</td>
        <td>{{$datas->date}}</td>
        <td>{{$datas->shed1_amount}}</td>
        <td>{{$datas->shed2_amount}}</td>
        <td>{{$datas->amount}}</td>
        <td>{{$datas->type}}</td>
       
                   
                    
        <td>
                        <div class="row">
                            <div class="col">
                            <a href="{{ route('medicine-inventory.edit', $datas->id) }}" class="btn btn-primary">Edit</a>
                            </div>
                            <div class="col">
                            <form action="{{ route('medicine-inventory.destroy', $datas->id) }}" method="POST">
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

