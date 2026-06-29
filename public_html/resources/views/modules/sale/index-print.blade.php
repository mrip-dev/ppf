@extends('layout.layout')
 @section('content')
<style>
    @media print {
    .no-print {
        display: none;
    }
}
</style>

<div class="">
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
           <div class="row">
            <div class="col-10 p-2">
                Date: {{ now()->format('d-m-Y') }} 
            </div>
            <div class="col-2">
                Doc No: {{$id}} 
            </div>
           </div>
           <hr>
		<table id="" class="table table-bordered">
				
             <thead>
            <tr>
                <th>S/R</th>
               
               
               
               
                <th>Specimen </th>
                <th>Specs </th>
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
    <div class="row p-4">
        <div class="col-4 ">______________ <br>Security Guard</div>
        <div class="col-4">______________ <br>Farm Incharge</div>
        <div class="col-4">______________ <br>Farm Supervisor</div>
    </div>
    <button onclick="window.print();" class="btn btn-success no-print ">
                                 Print
                               </button>
</div>

@endsection

