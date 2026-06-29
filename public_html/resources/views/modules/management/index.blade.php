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
           
            <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Shed1L Management</h4>
                                </div>
                            </div>
                        </div> <div class="row">
                    
                </div>
		<table id="zero-config" class="table">
				
             <thead>
            <tr>
                <th>ID</th>
                <th>Age</th>
               
                <th>Temperature</th>
                <th>Brooding Vents</th>
                <th>CFM </th>
                <th>Vent Opening </th>
                <th>Feeders</th>
                <th>Pad Length</th>
                <th>Pad Opening</th>
                <th>Fan 1 On Time</th>
                <th>Fan 1 Off Time</th>
                <th>Fan 2 On Time</th>
                <th>Fan 2 Off Time</th>
                <th>Fan 3 On Time</th>
                <th>Fan 3 Off Time</th>
                <th>Fan 4 On Time</th>
                <th>Fan 4 Off Time</th>
                <th>Fan 5 On Time</th>
                <th>Fan 5 Off Time</th>
                <th>Fan 6 On Time</th>
                <th>Fan 6 Off Time</th>
                <th>Fan 7 On Time</th>
                <th>Fan 7 Off Time</th>
                <th>Fan 8 On Time</th>
                <th>Fan 8 Off Time</th>
                <th>Fan 9 On Time</th>
                <th>Fan 9 Off Time</th>
                <th>Fan 10 On Time</th>
                <th>Fan 10 Off Time</th>
               
               
               
            </tr>
        </thead>
        <tbody>
        @foreach($data as $datas)
                <tr>
        <td>{{$datas->id}}</td>
        <td>{{$datas->age}}</td>
        <td>{{$datas->temperature}}</td>
        <td>{{$datas->brooding_vents}}</td>
        <td>{{$datas->cfm}}</td>
        <td>{{$datas->vent_opening}}</td>
        <td>{{$datas->feeders}}</td>
        <td>{{$datas->pad_length}}</td>
        <td>{{$datas->pad_opening}}</td>
        <td>{{$datas->fan_1_on_t}}</td>
        <td>{{$datas->fan_1_off_t}}</td>
        <td>{{$datas->fan_2_on_t}}</td>
        <td>{{$datas->fan_2_off_t}}</td>
        <td>{{$datas->fan_3_on_t}}</td>
        <td>{{$datas->fan_3_off_t}}</td>
        <td>{{$datas->fan_4_on_t}}</td>
        <td>{{$datas->fan_4_off_t}}</td>
        <td>{{$datas->fan_5_on_t}}</td>
        <td>{{$datas->fan_5_off_t}}</td>
        <td>{{$datas->fan_6_on_t}}</td>
        <td>{{$datas->fan_6_off_t}}</td>
        <td>{{$datas->fan_7_on_t}}</td>
        <td>{{$datas->fan_7_off_t}}</td>
        <td>{{$datas->fan_8_on_t}}</td>
        <td>{{$datas->fan_8_off_t}}</td>
        <td>{{$datas->fan_9_on_t}}</td>
        <td>{{$datas->fan_9_off_t}}</td>
        <td>{{$datas->fan_10_on_t}}</td>
        <td>{{$datas->fan_10_off_t}}</td>
        
       
                   
                    
       
                  
                </tr>
                @endforeach
        </tbody>
       
    </table>
   
			</div>
		</div>
	</div>
</div>

@endsection

