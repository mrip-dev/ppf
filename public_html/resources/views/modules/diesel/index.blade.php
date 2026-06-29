@extends('layout.layout')
 @section('content')


<div class="layout-px-spacing">
	<div class="middle-content container-xxl p-0">
        <form action="/diesel" method="get">
        <select class="form-control"  name="source_id" id="">
                                            <option value="" >Select Source</option>
                                           @foreach($source as $med)
                                            <option value="{{$med->id}}" <?php if($source_id==$med->id){ echo 'selected';}?>>{{$med->title}}</option>
                                            @endforeach
                                        </select>
                                        <input class="btn btn-success mt-2" type="submit"  value="Search" id="">
        </form>
		<!-- BREADCRUMB -->
        <div class="page-meta">
                                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/diesel">Diesel</a></li>

                                    </ol>
                                </nav>
                            </div>
                            <!-- /BREADCRUMB -->
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
                    <div class="col text-end">
                        <a href="/diesel/create" class="btn btn-primary">Add New</a>
                    </div>
                </div>
		<table id="diesel-inv" class="table">
				
             <thead>
            <tr>
                <th>ID</th>
               
                <th>Date</th>
                <th>Shed1 Brooding</th>
                <th>Shed1 Cum</th>
                <th>Shed2 Brooding</th>
                <th>Shed2 Cum</th>
                <th>Generator Consumption</th>
                <th>G.Tittle</th>
                <th>G.Desc</th>
                <th>Total Comsumption</th>
                <th>Comulative C</th>
                <th>Recieved Diesel</th>
                <th>Comulative R</th>
                <th>Stock</th>
                
              
               
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php $com_c=0;?>
            <?php $com_s1=0;?>
            <?php $com_s2=0;?>
            <?php $com_r=0;?>
            <?php $total_c=0;?>
        @foreach($data as $datas)
                <tr>
        <td>{{$datas->id}}</td>
        <td>{{$datas->date}}</td>
        <td>{{$datas->consumption_shed1}}</td>
        <td>{{$com_s1+=$datas->consumption_shed1}}</td>
        <td>{{$datas->consumption_shed2}}</td>
        <td>{{$com_s2+=$datas->consumption_shed2}}</td>
        <td>{{$datas->consumption_generator}}</td>
        <td>{{$datas->aset?->title}}</td>
        <td>{{$datas->aset?->desc}}</td>
       
           
           <?php $com_r+=$datas->amount;
           $total_c=$datas->consumption_shed1+$datas->consumption_shed2+$datas->consumption_generator;
           ?> 
       <td>{{$total_c}}</td>
          
         <?php $com_c+=$total_c;?> 
        <td>{{$com_c}}</td>
        <td>{{$datas->amount}}</td>  
        <td>{{$com_r}}</td>
        <td>{{$com_r-$com_c}}</td>
       
       
                   
                    
        <td>
                        <div class="row">
                            <div class="col">
                            <a href="{{ route('diesel.edit', $datas->id) }}" class="btn btn-primary">Edit</a>
                            </div>
                            <div class="col">
                            <form action="{{ route('diesel.destroy', $datas->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                            </div>
                        </div>
                        
                       
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

