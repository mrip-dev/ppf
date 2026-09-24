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
                            <h4>Shed1L Controller Report</h4>
                        </div>
                    </div>
                </div>
                <div class="row">

                </div>
                <table id="zero-config" class="table">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>House Temperature</th>
                            <th>Outside Temperature</th>
                            <th>Brooder Temperature</th>
                            <th>Humidity</th>
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
                            <th>Fan 11 On Time</th>
                            <th>Fan 11 Off Time</th>
                            <th>Fan 12 On Time</th>
                            <th>Fan 12 Off Time</th>
                            <th>Cool 1 On Time</th>
                            <th>Cool 1 Off Time</th>
                            <th>Cool 2 On Time</th>
                            <th>Cool 2 Off Time</th>
                            <th>Fan 1 On Temp</th>
                            <th>Fan 1 Off Temp</th>
                            <th>Fan 2 On Temp</th>
                            <th>Fan 2 Off Temp</th>
                            <th>Fan 3 On Temp</th>
                            <th>Fan 3 Off Temp</th>
                            <th>Fan 4 On Temp</th>
                            <th>Fan 4 Off Temp</th>
                            <th>Fan 5 On Temp</th>
                            <th>Fan 5 Off Temp</th>
                            <th>Fan 6 On Temp</th>
                            <th>Fan 6 Off Temp</th>
                            <th>Fan 7 On Temp</th>
                            <th>Fan 7 Off Temp</th>
                            <th>Fan 8 On Temp</th>
                            <th>Fan 8 Off Temp</th>
                            <th>Fan 9 On Temp</th>
                            <th>Fan 9 Off Temp</th>
                            <th>Fan 10 On Temp</th>
                            <th>Fan 10 Off Temp</th>
                            <th>Fan 11 On Temp</th>
                            <th>Fan 11 Off Temp</th>
                            <th>Fan 12 On Temp</th>
                            <th>Fan 12 Off Temp</th>
                            <th>Cool 1 On Temp</th>
                            <th>Cool 1 Off Temp</th>
                            <th>Cool 2 On Temp</th>
                            <th>Cool 2 Off Temp</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Action</th>






                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $datas)
                        <tr>
                        <td>{{$datas->custom_id}}</td>
                            <td>{{ $datas->temperature }}</td>
                            <td>{{ $datas->temp3_outside }}</td>
                            <td>{{ $datas->temp2_brooder }}</td>
                            <td>{{ $datas->humidity }}</td>
                            <td>{{ $datas->fan1_on_time }}</td>
                            <td>{{ $datas->fan1_off_time }}</td>
                            <td>{{ $datas->fan2_on_time }}</td>
                            <td>{{ $datas->fan2_off_time }}</td>
                            <td>{{ $datas->fan3_on_time }}</td>
                            <td>{{ $datas->fan3_off_time }}</td>
                            <td>{{ $datas->fan4_on_time }}</td>
                            <td>{{ $datas->fan4_off_time }}</td>
                            <td>{{ $datas->fan5_on_time }}</td>
                            <td>{{ $datas->fan5_off_time }}</td>
                            <td>{{ $datas->fan6_on_time }}</td>
                            <td>{{ $datas->fan6_off_time }}</td>
                            <td>{{ $datas->fan7_on_time }}</td>
                            <td>{{ $datas->fan7_off_time }}</td>
                            <td>{{ $datas->fan8_on_time }}</td>
                            <td>{{ $datas->fan8_off_time }}</td>
                            <td>{{ $datas->fan9_on_time }}</td>
                            <td>{{ $datas->fan9_off_time }}</td>
                            <td>{{ $datas->fan10_on_time }}</td>
                            <td>{{ $datas->fan10_off_time }}</td>
                            <td>{{ $datas->fan11_on_time }}</td>
                            <td>{{ $datas->fan11_off_time }}</td>
                            <td>{{ $datas->fan12_on_time }}</td>
                            <td>{{ $datas->fan12_off_time }}</td>
                            <td>{{ $datas->pad1_on_time }}</td>
                            <td>{{ $datas->pad1_off_time }}</td>
                            <td>{{ $datas->pad2_on_time }}</td>
                            <td>{{ $datas->pad2_off_time }}</td>

                            <td>{{ $datas->fan1_on_temp }}</td>
                            <td>{{ $datas->fan1_off_temp }}</td>
                            <td>{{ $datas->fan2_on_temp }}</td>
                            <td>{{ $datas->fan2_off_temp }}</td>
                            <td>{{ $datas->fan3_on_temp }}</td>
                            <td>{{ $datas->fan3_off_temp }}</td>
                            <td>{{ $datas->fan4_on_temp }}</td>
                            <td>{{ $datas->fan4_off_temp }}</td>
                            <td>{{ $datas->fan5_on_temp }}</td>
                            <td>{{ $datas->fan5_off_temp }}</td>
                            <td>{{ $datas->fan6_on_temp }}</td>
                            <td>{{ $datas->fan6_off_temp }}</td>
                            <td>{{ $datas->fan7_on_temp }}</td>
                            <td>{{ $datas->fan7_off_temp }}</td>
                            <td>{{ $datas->fan8_on_temp }}</td>
                            <td>{{ $datas->fan8_off_temp }}</td>
                            <td>{{ $datas->fan9_on_temp }}</td>
                            <td>{{ $datas->fan9_off_temp }}</td>
                            <td>{{ $datas->fan10_on_temp }}</td>
                            <td>{{ $datas->fan10_off_temp }}</td>
                            <td>{{ $datas->fan11_on_temp }}</td>
                            <td>{{ $datas->fan11_off_temp }}</td>
                            <td>{{ $datas->fan12_on_temp }}</td>
                            <td>{{ $datas->fan12_off_temp }}</td>
                            <td>{{ $datas->pad1_on_temp }}</td>
                            <td>{{ $datas->pad1_off_temp }}</td>
                            <td>{{ $datas->pad2_on_temp }}</td>
                            <td>{{ $datas->pad2_off_temp }}</td>
                            <td>{{ $datas->date }}</td>
                            <td>{{ $datas->time }}</td>

                            <td>
                                <form action="{{ url('/cr1/del/' . $datas->custom_id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>

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