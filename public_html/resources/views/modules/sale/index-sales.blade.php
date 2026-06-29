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
                                    <p><strong>Type:</strong>{{$type}}</p>
                                </div>
                            </div>
            <div class="widget-header">
                            <div class="row m-3 p-3">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                               
                                </div>
                            </div>
                        </div> <div class="row">
                    
                </div>
		<table id="zero-config" class="table">
				
             <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
               
               
               
                <th>Specimen </th>
                <th>Specifications </th>
                <th>Unit </th>
                <th>From</th>
                <th>Bill No</th>
                <th>Driver</th>
                <th>Category</th>
                <th>Price/Unit</th>
               
                <th>Amount</th>
                <th>Quantity</th> 
               
               
               
               
            </tr>
        </thead>
        <tbody>
        @foreach($data as $datas)
                <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$datas->created_at}}</td>
       
        
       
        <td>{{$datas->spec_name}}</td>
        <td>{{$datas->specs}}</td>
        <td>{{$datas->unit}}</td>
        <td>{{$datas->from}}</td>
        <td>{{$datas->bill_no}}</td>
        <td>{{$datas->driver}}</td>
        <td>{{$datas->sect?->name}}</td>
        <td>{{$datas->price}}</td>
       
        <td>{{$datas->amount}}</td>
        <td>{{$datas->quantity}}</td>
        
        
       
                   
                    
       
                  
                </tr>
                @endforeach
        </tbody>
       
    </table>
   
			</div>
		</div>
	</div>
</div>

@endsection

