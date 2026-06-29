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
        <form action="/wood" method="get">
        <select class="form-control"  name="source_id" id="">
                                            <option value="" >Select Source</option>
                                           @foreach($source as $med)
                                            <option value="{{$med->id}}" <?php if($source_id==$med->id){ echo 'selected';}?>>{{$med->title}}</option>
                                            @endforeach
                                        </select>
                                        <input class="btn btn-info mt-2" type="submit"  value="Search" >
        </form>  
			<div class="widget-content widget-content-area br-8 mt-4">
            
            <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Wood</h4>
                                </div>
                            </div>
                        </div> <div class="row">
                    <div class="col text-end">
                        <a href="/wood/create" class="btn btn-primary">Add New</a>
                    </div>
                </div>
		<table id="diesel-inv" class="table">
				
             <thead>
             <tr>
                <th>ID</th>
               
                <th>Date</th>
                <th>Consumed By</th>
                <th>Desc</th>
                <th>Total Comsumed</th>
                <th>Comulative C</th>
                <th>Recieved Wood</th>
                <th>Comulative R</th>
                <th>Stock</th>
                
              
               
                <th>Actions</th>
            </tr>
            </tr>
        </thead>
        <?php $com_c=0;?>
            <?php $com_r=0;?>
        @foreach($data as $datas)
                <tr>
        <td>{{$datas->id}}</td>
        <td>{{$datas->date}}</td>
        <td>{{$datas->aset?->title}}</td>
        <td>{{$datas->aset?->desc}}</td>
        @if($datas->type=='Received')
           <td>0</td> 
           <?php $com_r+=$datas->amount;?> 
         @else
         <td>{{$datas->amount}}</td> 
         <?php $com_c+=$datas->amount;?> 
         @endif
       
        <td>{{$com_c}}</td>
       
         @if($datas->type=='Received')
           
           <td>{{$datas->amount}}</td>  
         @else
           <td>0</td> 
         @endif
        
        <td>{{$com_r}}</td>
        <td>{{$com_r-$com_c}}</td>
       
       
        <td>
                        <div class="row">
                            <div class="col">
                            <a href="{{ route('wood.edit', $datas->id) }}" class="btn btn-primary">Edit</a>
                            </div>
                            <div class="col">
                            <form action="{{ route('wood.destroy', $datas->id) }}" method="POST">
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

