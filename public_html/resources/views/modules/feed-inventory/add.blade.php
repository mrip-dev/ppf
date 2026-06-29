@extends('layout.layout')
 @section('content')
<div class="layout-px-spacing">

    <div class="middle-content container-xxl p-0">
   <!-- BREADCRUMB -->
   <div class="page-meta">
                                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/feed-inventory">Feed</a></li>
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
                            <form action="{{ route('feed-inventory.store') }}" class="m-3 p-3" method="POST">
                                @csrf
                                   <div class="row">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Date</label>
                                        <input type="date" required class="form-control" name="date" id="name" value="{{ old('date') }}" placeholder="Enter Date">
                                        <input type="hidden" class="form-control" name="item_type" id="name" value="1">
                                        <input type="hidden" class="form-control" name="title" id="name" value="Feed">

                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Type</label>
                                        <select class="form-control" onchange="setType(this.value)" required name="type" id="">
                                            <option value="" >Select Type</option>
                                            <option >Received</option>
                                            <!-- <option >Consumed</option> -->
                                        </select>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="form-group col-6 mb-2 " id="recieved_amount">
                                        <label for="name">Amount/Bags</label>
                                        <input type="text" class="form-control" name="feed_recieved" id="name" value="{{ old('amount') }}" placeholder="Enter Amount">
                                    </div>
                                    
                                    <!-- <div class="form-group col-6 mb-2">
                                        <label for="name">Night Mor</label>
                                        <input type="text" class="form-control" name="night_mor" id="name" value="{{ old('name') }}" placeholder="Enter Night Mor">
                                    </div> -->
                                    </div>
                                    <div class="row d-none" id="consumed_amount">
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Shed 1L Amount</label>
                                        <input type="text" class="form-control" name="shed1_amount" id="name" value="{{ old('date') }}" placeholder="Enter Shed 1L Amount">
                                    </div>
                                    <div class="form-group col-6 mb-2">
                                        <label for="name">Shed 2R Amount</label>
                                        <input type="text" class="form-control" name="shed2_amount" id="name" value="{{ old('amount') }}" placeholder="Enter Shed 2L Amount">
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
            $("#recieved_amount").addClass('d-none');
        }else{
            $("#consumed_amount").addClass('d-none');
            $("#recieved_amount").removeClass('d-none');
        }
    }
</script>
@endsection
