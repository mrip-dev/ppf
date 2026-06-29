@extends('layout.layout')
 @section('content')


<div class="layout-px-spacing">
	<div class="middle-content container-xxl p-0">
		<!-- BREADCRUMB -->
        <div class="page-meta">
                                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item active" aria-current="page">Feed</li>
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
                        <a href="/feed-inventory/create" class="btn btn-primary">Add New</a>
                    </div>
                </div>
		<table id="zero-config" class="table">
				
             <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Shed 1L Amount/Bags</th>
                <th>Shed 2R Amount/Bags</th>
                <th>Total Comsumed</th>
                <th>Comulative C</th>
                <th>Recieved Bags</th>
                <th>Comulative R</th>
                <th>Stock Bags</th>
               
               
                
              
               
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $com_c=0;?>
            <?php $com_r=0;?>
        @foreach($data as $datas)
                <tr>
        <td>{{$loop->iteration}}</td>
      
        <td>{{$datas->date}}</td>
        <td>{{$datas->shed1_amount}}</td>
        <td>{{$datas->shed2_amount}}</td>
       
        
           
        <?php $com_r=$com_r+$datas->feed_recieved;?> 
       
         <td>{{$datas->amount}}</td> 
         <?php $com_c+=$datas->amount;?> 
       
       
        <td>{{$com_c}}</td>
       
        
           
           <td>{{$datas->feed_recieved}}</td>  
        
           
       
        
        <td>{{$com_r}}</td>
        <td>{{$com_r-$com_c}}</td>
       
                   
                    
        <td>
                        <div class="row">
                            <div class="col">
                            <a href="{{ route('feed-inventory.edit', $datas->id) }}" class="btn btn-primary">Edit</a>
                            </div>
                            <div class="col">
                            <form action="{{ route('feed-inventory.destroy', $datas->id) }}" method="POST">
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

