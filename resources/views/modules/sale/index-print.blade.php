@extends('layout.layout')
@section('content')
<style>
    @media print {
        .no-print {
            display: none;
        }
    }

    .specimen {
        white-space: normal !important;
        word-wrap: break-word;
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
                        <h1>{{$farm?->company_name}}</h1>
                        <h2>{{$farm?->name}}</h2>
                        <p>{{$farm?->address}}</p>
                        <p>FLock No: {{$flock?->flock_no}} </p>
                        <p><strong>Type:</strong>{{$type}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-10 p-2">
                        Date: {{ now()->format('d-m-Y') }}
                    </div>
                    <div class="col-2">
                        Doc No: {{$docno}}
                    </div>
                </div>
                <hr>
                <table id="" class="table table-bordered">

                    <thead>
                        <tr>
                            <th>S/R</th>
                            <th>Specimen </th>
                            <th>Specs </th>
                            <th>Quantity</th>
                            
                            <th>Unit </th>
                            <th>From</th>
                            <th>Bill No</th>
                            <th>Driver</th>
                            <th>Category</th>
                            <th>Price/Unit</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                     <tbody>
                            @php $counter = 0; @endphp
                            @foreach($data as $datas)
                            @if($counter < 8)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td class="specimen">{{$datas->spec_name}}</td>
                            <td class="specimen">{{$datas->specs}}</td>
                            <td class="specimen">{{$datas->quantity}}</td>
                            
                            <td class="specimen">{{$datas->unit}}</td>
                            <td class="specimen">{{$datas->from}}</td>
                            <td class="specimen">{{$datas->bill_no}}</td>
                            <td class="specimen">{{$datas->driver}}</td>
                            <td class="specimen">{{$datas->sect?->name}}</td>
                            <td class="specimen">{{$datas->price}}</td>
                            <td class="specimen">{{$datas->amount}}</td>
                        </tr>
                            @php $counter++; @endphp
                            @endif
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row p-4">
        <div class="col-3 ">______________ <br>Security Guard</div>
        <div class="col-3">______________ <br>Farm Incharge</div>
        <div class="col-3">______________ <br>Farm Supervisor</div>
        <div class="col-3">______________ <br>Received By</div>
    </div>
    <button onclick="window.print();" class="btn btn-success no-print ">
        Print
    </button>
</div>

@endsection
