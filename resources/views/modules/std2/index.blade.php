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
            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h2 class="m-3">Report</h2>
                                </div>
                            </div>
            <div class="row">
                    <!-- <div class="col text-end">
                        <a href="/flock-standard/create" class="btn btn-primary">Add New</a>
                    </div> -->
                </div>
		<table id="flock-standard" class="table">
				
             <thead>
            <tr>
                <th>ID</th>
                <th>Day</th>
                <th>Feed Ross</th>
                <th>Feed Current</th>
                <th>Feed Diff</th>
                <th>Cumm Feed Ross</th>
                <th>Cumm Feed Current</th>
                <th>Feed Bags Ross</th>
                <th>Feed Bags Current</th>
                <th>Cumm Feed Bags Ross</th>
                <th>Cumm Feed Bags Current</th>

             
               
            </tr>
        </thead>
        <tbody>
        <?php $commulative_feedross=0;
         $commulative_feedcf=0;
         $commulative_fbc=0;
         $commulative_fbross=0;
         ?>
        @foreach($data as $datas)
                <tr>
<?php $usedfeed=App\Http\Controllers\Controller::getFeedUsedByAge2($datas->day);
 $rem_b=$usedfeed['b']-$usedfeed['m']?>
 
        <td>{{$datas->id}}</td>
      
        <td>{{$datas->day}}</td>
        <td>{{$datas->feed}}</td>
        <td><?Php $cf=$usedfeed['f']*50000/$rem_b; echo round($cf);  ?></td>
        <td><?Php echo round($datas->feed-$cf);  ?></td>
        <?php $commulative_feedross=$commulative_feedross+$datas->feed;
        $commulative_feedcf=$commulative_feedcf+$cf;
        
       
  
  ?>
        <td>{{$commulative_feedross}}</td>
        <td><?Php  echo round($commulative_feedcf);?></td>
        <td><?Php $rb=$datas->feed*($rem_b)/50000; echo round($rb);  ?></td>
        <td>{{$usedfeed['f']}}</td>
        <?php $commulative_fbross=$commulative_fbross+$rb;
        $commulative_fbc= $commulative_fbc+$usedfeed['f'];
        
       
  
  ?>
       <td><?Php  echo round($commulative_fbross);?></td>
        <td><?Php  echo round($commulative_fbc);?></td>
        
      
      
                    
       
                  
                </tr>
                @endforeach
        </tbody>
       
    </table>
   
			</div>
		</div>
	</div>
</div>

@endsection

