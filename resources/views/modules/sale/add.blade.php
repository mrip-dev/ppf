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
                                    <h4>Add New</h4>
                                </div>
                            </div>
                        </div>

                        <div class="widget-content widget-content-area">
                            <form action="{{ route('sale.store') }}" class="m-3 p-3" method="POST">
                                @csrf
                                <input type="hidden" name="" id="car_counter" value="1">
                                    <!-- ////////   GAte pass Table  -->
                                    <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Type</label>
                                        <select class="form-control" required name="type" id="">
                                            <option  value="">Select Type</option>
                                            <option >Inward</option>
                                            <option >Outward</option>
                                           
                                        </select>
                                      </div>
                                    </div>
                                    <!-- ////////   GAte pass Table end -->

                           <div class="outer_div" id="outer_div">

                                
                           
                                    <!-- ////////   Sale Table  -->
                                <div class="card p-2 shadow" id="card_1">
                                       <div class="row">
                                          <div class="col-11">
                                          </div>
                                          <div class="col-1">
                                              <button type="button" class="btn btn-success" onclick="copyCard()">+</button>
                                          </div>
                                       </div>

                                   
                                    <div class="row">
                                        <div class="form-group col mb-2">
                                           <label for="spec_name">Specimen Name</label>
                                           <input type="text" class="form-control" name="spec_name[]" id="spec_name" value="{{ old('spec_name') }}" placeholder="Enter Specimen">
                                        </div>
                                        <div class="form-group col mb-2">
                                           <label for="specs">Specifications</label>
                                           <input type="text" class="form-control" name="specs[]" id="specs" value="{{ old('specs') }}" placeholder="Enter Specifications">
                                        </div>
                                 
                                        <div class="form-group col mb-2 " id="g1">
                                          <label for="name">Category</label>
                                           <select class="form-control"  name="category[]" id="">
                                            <option value="" >Select  </option>
                                             @foreach($source as $cat)
                                              <option value="{{$cat->id}}">{{$cat->name}}</option>
                                             @endforeach
                                           </select>
                                        </div>
                                         <div class="form-group col mb-2">
                                           <label for="quantity">Quantity</label>
                                           <input type="number" class="form-control" name="quantity[]" id="quantity" value="{{ old('quantity')}}" placeholder="Enter QTY">
                                         </div>
                                
                                         <div class="form-group col mb-2">
                                           <label for="unit">Unit</label>
                                           <input type="text" class="form-control" name="unit[]" id="unit" value="{{ old('unit') }}" placeholder="Enterunit">
                                         </div>
                                    </div>
                                  <div class="row">
                                      <div class="form-group col mb-2">
                                        <label for="from">From</label>
                                        <input type="text" class="form-control" name="from[]" id="from" value="{{ old('from') }}" placeholder="Enter From">
                                      </div>
                                  
                                      <div class="form-group col mb-2">
                                        <label for="bill_no">Bill No</label>
                                        <input type="text" class="form-control" name="bill_no[]" id="bill_no" value="{{ old('bill_no') }}" placeholder="Enter Bill No">
                                      </div>
                                      <div class="form-group col mb-2">
                                        <label for="driver">Driver</label>
                                        <input type="text" class="form-control" name="driver[]" Driverd="driver" value="{{ old('driver')}}" placeholder="Enter Driver">
                                      </div>
                                  
                                      <div class="form-group col mb-2">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control" name="price[]" id="price" value="{{ old('price') }}" placeholder="Enter Price">
                                      </div>
                                     
                                   
                                   
                                      <div class="form-group col mb-2">
                                        <label for="amount">Amount</label>
                                        <input type="number" class="form-control" name="amount[]" id="amount" value="{{ old('amount') }}" placeholder="Enter Amount">
                                      </div>
                                     
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
  function copyCard(){
    var id=$("#car_counter").val();
    var nextid=parseInt(id)+1;
    var new_card=`<div class="card p-2 shadow" id="card_${nextid}">
                                       <div class="row">
                                          <div class="col-11">
                                          </div>
                                          <div class="col-1">
                                              <button type="button" class="btn btn-danger" onclick="removeCard(${nextid})">X</button>
                                          </div>
                                       </div>

                                   
                                    <div class="row">
                                        <div class="form-group col mb-2">
                                           <label for="spec_name">Specimen Name</label>
                                           <input type="text" class="form-control" name="spec_name[]" id="spec_name" value="{{ old('spec_name') }}" placeholder="Enter Specimen">
                                        </div>
                                        <div class="form-group col mb-2">
                                           <label for="specs">Specifications</label>
                                           <input type="text" class="form-control" name="specs[]" id="specs" value="{{ old('specs') }}" placeholder="Enter Specifications">
                                        </div>
                                 
                                        <div class="form-group col mb-2 " id="g1">
                                          <label for="name">Category</label>
                                           <select class="form-control"  name="category[]" id="">
                                            <option value="" >Select  </option>
                                             @foreach($source as $cat)
                                              <option value="{{$cat->id}}">{{$cat->name}}</option>
                                             @endforeach
                                           </select>
                                        </div>
                                         <div class="form-group col mb-2">
                                           <label for="quantity">Quantity</label>
                                           <input type="number" class="form-control" name="quantity[]" id="quantity" value="{{ old('quantity')}}" placeholder="Enter QTY">
                                         </div>
                                
                                         <div class="form-group col mb-2">
                                           <label for="unit">Unit</label>
                                           <input type="text" class="form-control" name="unit[]" id="unit" value="{{ old('unit') }}" placeholder="Enterunit">
                                         </div>
                                    </div>
                                  <div class="row">
                                      <div class="form-group col mb-2">
                                        <label for="from">From</label>
                                        <input type="text" class="form-control" name="from[]" id="from" value="{{ old('from') }}" placeholder="Enter From">
                                      </div>
                                  
                                      <div class="form-group col mb-2">
                                        <label for="bill_no">Bill No</label>
                                        <input type="text" class="form-control" name="bill_no[]" id="bill_no" value="{{ old('bill_no') }}" placeholder="Enter Bill No">
                                      </div>
                                      <div class="form-group col mb-2">
                                        <label for="driver">Driver</label>
                                        <input type="text" class="form-control" name="driver[]" Driverd="driver" value="{{ old('driver')}}" placeholder="Enter Driver">
                                      </div>
                                  
                                      <div class="form-group col mb-2">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control" name="price[]" id="price" value="{{ old('price') }}" placeholder="Enter Price">
                                      </div>
                                     
                                   
                                   
                                      <div class="form-group col mb-2">
                                        <label for="amount">Amount</label>
                                        <input type="number" class="form-control" name="amount[]" id="amount" value="{{ old('amount') }}" placeholder="Enter Amount">
                                      </div>
                                     
                                  </div>
                                </div>`;

                                $("#outer_div").append(new_card);
                                $("#car_counter").val(nextid);
  }
  function removeCard(id){
    $("#card_"+id).remove();

  }
</script>

@endsection
