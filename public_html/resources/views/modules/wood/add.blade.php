@extends('layout.layout')
 @section('content')
<div class="layout-px-spacing">

    <div class="middle-content container-xxl p-0">

        <div class="row layout-top-spacing">

            <div class="middle-content container-xxl p-0">
                <!--- registration form start --->
                <div class="col-lg-12 col-12  layout-spacing">

                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Add Wood</h4>
                                </div>
                            </div>
                        </div>

                        <div class="widget-content widget-content-area">
                            <form action="{{ route('wood.store') }}" class="m-3 p-3" method="POST">
                                @csrf
                                   <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Date</label>
                                        <input type="date" required class="form-control" name="date" id="name" value="{{ old('date') }}" placeholder="Enter Date">
                                        <input type="hidden" class="form-control" name="item_type" id="name" value="1">
                                        <input type="hidden" class="form-control" name="title" id="name" value="Wood">

                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Amount/Kg</label>
                                        <input type="text" required class="form-control" name="amount" id="name" value="{{ old('amount') }}" placeholder="Enter Amount">
                                    </div>
                                    </div>
                                    <div class="row">

                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Type</label>
                                        <select class="form-control"  onchange="setType(this.value)" required name="type" id="">
                                            <option value="" >Select Type</option>
                                            <option >Received</option>
                                            <option >Consumed</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-6 mb-2 d-none" id="consumed_amount">
                                    <label for="name">Consumed By</label>
                                        <select class="form-control"  name="source" id="">
                                            <option value="" >Select Source</option>
                                           @foreach($source as $med)
                                            <option value="{{$med->id}}">{{$med->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                                    <div class="row d-none" id="consumed_amount2">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Duration</label>
                                        <input type="number"  class="form-control"  name="time" id="name" value="{{ old('date') }}" placeholder="Enter Duration">
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Load (Amp)</label>
                                        <input type="number"   name="load" id="name" class="form-control" value="{{ old('amount') }}" placeholder="Enter Load">
                                    </div>
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
        if(type=='Consumed'){
            $("#consumed_amount").removeClass('d-none');
            $("#consumed_amount2").removeClass('d-none');
    
        }else{
            $("#consumed_amount").addClass('d-none');
            $("#consumed_amount2").addClass('d-none');
        }
    }
</script>
@endsection
