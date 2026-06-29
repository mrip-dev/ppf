
@extends('layout.layout')

 @section('content')
<div class="layout-px-spacing">

    <div class="middle-content container-xxl p-0">
<!-- BREADCRUMB -->
<div class="page-meta">
                                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/diesel">Diesel</a></li>
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
                            <form action="{{ route('diesel.store') }}" class="m-3 p-3" method="POST">
                                @csrf
                                   <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Date</label>
                                        <input type="date" required class="form-control" name="date" id="name" value="{{ old('date') }}" placeholder="Enter Date">
                                        <input type="hidden" class="form-control" name="item_type" id="name" value="1">
                                        <input type="hidden" class="form-control" name="title" id="name" value="Diesel">

                                    </div>
                                    <div class="form-group col-6 mb-2 " id="consumed_amount4">
                                        <label for="name">Received Amount/Litres</label>
                                        <input type="text"  class="form-control" name="amount" id="r_amount" value="{{ old('amount') }}" placeholder="Enter Amount">
                                    </div>
                                    </div>
                                    <div class="row">

                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Type</label>
                                        <select class="form-control" onchange="setType(this.value)" name="type" id="">
                                            <option value="" >Select Type</option>
                                            <option >Received</option>
                                            <option >Consumed</option>
                                        </select>

                                    </div>
                                     </div>
                                     <div class="row d-none" id="consumed_amount5">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Load</label>
                                        <input type="number"  class="form-control"  name="load" id="load" value="{{ old('date') }}" placeholder="Enter Load">
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Duration</label>
                                        <input type="number"   name="duration" id="duration" class="form-control" value="{{ old('amount') }}" placeholder="Enter Duration">
                                    </div>
                                    </div>
                                    
                                    <div class="row d-none" id="consumed_amount2">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Shed1 Brooding Consumption</label>
                                        <input type="text"  class="form-control"  name="consumption_shed1" id="c1" value="{{ old('date') }}" placeholder="Enter Shed1 Brooding Consumption">
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Shed2 Brooding Consumption</label>
                                        <input type="text"   name="consumption_shed2" id="c2" class="form-control" value="{{ old('amount') }}" placeholder="Enter Shed1 Brooding Consumption">
                                    </div>
                                    </div>
                                    <hr>
                                    <div class="row d-none" id="consumed_amount3">
                                    <div class="form-group col-6 mb-2 d-none" id="g1">
                                     <label for="name">Generator Type</label>
                                        <select class="form-control"  name="source" id="">
                                            <option value="" >Select Generator </option>
                                           @foreach($source as $med)
                                            <option value="{{$med->id}}">{{$med->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Generator Consumption</label>
                                        <input type="text"  class="form-control"  name="consumption_generator" id="g" value="{{ old('date') }}" placeholder="Enter Consumption">
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
<script>
    function setType(type){
        
        $("#r_amount").val('');
        $("#load").val('');
        $("#duration").val('');
        $("#c1").val('');
        $("#c2").val('');
        $("#g").val('');
        $("#g1").val('');
        
        
        
        
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
        }
    }
</script>

@endsection
