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
                                        <li class="breadcrumb-item"><a href="/feed-inventory">Diesel</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                                    </ol>
                                </nav>
                            </div>
                            <!-- /BREADCRUMB -->
                <!-- Edit form start -->
                <div class="col-lg-12 col-12  layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Edit Data</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="{{ route('diesel.update', $data->id) }}" class="m-3 p-3" method="POST">
                                @csrf
                                @method('PUT') <!-- Use PUT method for updating -->
                                <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Date</label>
                                        <input type="date" required class="form-control" name="date" id="name" value="{{ $data->date }}" placeholder="Enter Date">
                                        <input type="hidden" class="form-control" name="item_type" id="name" value="1">
                                        <input type="hidden" class="form-control" name="title" id="name" value="Feed">
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Received Amount</label>
                                        <input type="text"  class="form-control" name="amount" id="name" value="{{ $data->amount }}" placeholder="Enter Amount">
                                    </div>
                                    </div>
                                    <div class="row">

                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Type</label>
                                        <select class="form-control" onchange="setType(this.value)" value="{{ $data->type }}" required name="type" id="">
                                            <option value="" >Select type</option>
                                            <option <?php if($data->type=='Received'){ echo 'selected';}?>>Received</option>
                                            <option <?php if($data->type=='Consumed'){ echo 'selected';}?>>Consumed</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="row d-none" id="consumed_amount">
                                    <div class="form-group col-6 mb-2 " id="">
                                    <label for="name">Generator Type</label>
                                        <select class="form-control"  name="source" id="">
                                            <option value="" >Select Source</option>
                                           @foreach($source as $med)
                                            <option value="{{$med->id}}" <?php if($data->aset->id==$data->source){ echo 'selected';}?>>{{$med->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Generator Consumption</label>
                                        <input type="text" value="{{$data->consumption_generator}}"  class="form-control"  name="consumption_generator" id="name" value="{{ old('date') }}" placeholder="Enter Consumption">
                                    </div>
                                    </div>
                                    <div class="row d-none" id="consumed_amount3">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Shed1 Brooding</label>
                                        <input type="text" value="{{$data->consumption_shed1}}"  class="form-control"  name="consumption_shed1" id="name" value="{{ old('date') }}" placeholder="Enter consumption">
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Shed2 Brooding</label>
                                        <input type="text" value="{{$data->consumption_shed2}}"    name="consumption_shed2" id="name" class="form-control" value="{{ old('amount') }}" placeholder="Enter consumption">
                                    </div>
                                    </div>
                                    
                                    <div class="row d-none" id="consumed_amount2">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Duration</label>
                                        <input type="number" value="{{$data->time}}"  class="form-control"  name="time" id="name" value="{{ old('date') }}" placeholder="Enter Duration">
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Load (Amp)</label>
                                        <input type="number" value="{{$data->load}}"    name="load" id="name" class="form-control" value="{{ old('amount') }}" placeholder="Enter Load">
                                    </div>
                                    </div>
                                    </div>
                                <!-- Add other fields here -->
                                <div class="form-group col-6 mb-2">
                                    <input type="submit" value="Update" class="btn btn-primary m-3">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Edit form end -->
            </div>
        </div>
    </div>
</div>
<script>
    function setType(type){
        if(type=='Consumed'){
            $("#consumed_amount").removeClass('d-none');
            $("#consumed_amount2").removeClass('d-none');
            $("#consumed_amount3").removeClass('d-none');
            $("#consumed_amount5").removeClass('d-none');
            $("#consumed_amount4").addClass('d-none');
        }else{
            $("#consumed_amount").addClass('d-none');
            $("#consumed_amount2").addClass('d-none');
            $("#consumed_amount5").addClass('d-none');
            $("#consumed_amount3").addClass('d-none');
            $("#consumed_amount4").removeClass('d-none');
        }}
    $( document ).ready(function() {
        setType('{{$data->type}}');
    });
</script>
@endsection
