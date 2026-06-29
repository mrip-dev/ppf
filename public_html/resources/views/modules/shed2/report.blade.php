@extends('layout.layout')
 @section('content')


<div class="layout-px-spacing">
	<div class="middle-content container-xxl p-0">
		 <!-- BREADCRUMB -->
         <div class="page-meta">
                                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/shed2">Assets</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Report</li>
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
                                <div class="text-center col-12">
                                    <h1>{{$farm?->name}}</h1>
                                    <p>{{$farm?->address}}</p>
                                </div>
                            </div>
            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h2 class="m-3">Shed2R Report</h2>
                                </div>
                            </div>
            <div class="row">
                    <div class="col text-end">
                        <a href="/shed2/create" class="btn btn-primary">Add New</a>
                    </div>
                </div>
		<table id="zero-config" class="table">
				
             <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Age</th>
                <th>Day Mortality</th>
                <th>Night Mortality</th>
                <th>Total Mortality</th>
                <th>Commulative Mortality</th>
                <th>Remaining</th>
                <th>Percentage Mortality</th>
              
                <th>Plan Factor</th>
                <th>Day Feed</th>
                <th>Night Feed</th>
                <th>Total Feed</th>
                <th>Commulative Feed</th>
                <th>Plan Bags</th>
                <th>Feed Factor</th>
                <th>Weight(g)</th>
                <th>F.C.R</th>
                <th>F.E.R</th>
                <th>FI/Bird</th>
                <th>CUM/Bird</th>
                <th>DWG</th>
                <th>Water Intake</th>
               
                <th>F/W</th>
                <th>Feed Received</th>
                <th>Cum Received</th>
                <th>Stock</th>

               
            </tr>
        </thead>
        <tbody>
        <?php $commulative_feed=0;
         $commulative_mor=0;
         $cum_rec=0;
         $fer=0;
         $cumbird=0;
         $old_weight=0;?>
        @foreach($data as $datas)
                <tr>
        <td>{{$datas->id}}</td>
        <td>{{$datas->date}}</td>
        <td>{{$datas->age}}</td>
        <td>{{$datas->day_mor}}</td>
        <td>{{$datas->night_mor}}</td>
        <td>{{$datas->day_mor+$datas->night_mor}}</td>
        <?php $commulative_mor=$commulative_mor+$datas->day_mor+$datas->night_mor;
        
              $rem_mor=$flock->str_shed1-$commulative_mor;
              $percent_mor=($commulative_mor/$rem_mor)*100;
        
        
        ?>
        <td>{{$commulative_mor}}</td>
        <td>{{$rem_mor}}</td>
        <td>{{number_format($percent_mor,3)}}</td>
       
        <td>{{$datas->plan_factor}}</td>
        <td>{{$datas->day_feed}}</td>
        <td>{{$datas->night_feed}}</td>
        <td>{{$total_feed=$datas->day_feed+$datas->night_feed}}</td>
        <?php $commulative_feed=$commulative_feed+$datas->day_feed+$datas->night_feed;?>
        <td>{{$commulative_feed}}</td>
        <td>
            <?php
            $plan_bags=0;
            $age=$datas->age;
            $plan_factor=$datas->plan_factor;
            $remaining_birds=$rem_mor;
            $plan_bags=($age*$remaining_birds*$plan_factor)/50000;
            
            ?>
            {{number_format($plan_bags)}}
           
        </td>
        <td>
        <?php
            $feed_factor=0;
            $feed_factor=($total_feed*50000)/($age*$remaining_birds);
            
            ?>

            {{number_format($feed_factor,2)}}</td>
        <td>{{$datas->weight}}</td>
        <?php $fibird=($total_feed*50000)/$remaining_birds;
        
        $fer=($remaining_birds*$datas->weight)/($commulative_feed*1000);
  ?>
  <td><?php  echo number_format(50/$fer,2)?></td>
  <td><?php  echo number_format($fer,2)?></td>
        <td>{{number_format($fibird,2)}}</td>
         <td><?php $cumbird=$cumbird+$fibird;
        
        echo number_format($cumbird,2);
         ?></td>
        <td>{{$datas->weight-$old_weight}}</td>
        <td>{{$datas->water_intake}}</td>
        <td><?php $fw=$datas->water_intake/($total_feed*50);
        
                  echo number_format($fw,2);
        ?></td>
        <td>{{$datas->feed_recieved}}</td>
        <?php $cum_rec=$cum_rec+$datas->feed_recieved;?>

        <td><?php echo $cum_rec; ?></td>
        <td><?php echo $cum_rec-$commulative_feed; ?></td>

        
                   
                    
        <!-- <td>
                        <div class="row">
                            <div class="col">
                            <a href="{{ route('shed2.edit', $datas->id) }}" class="btn btn-primary">Edit</a>
                            </div>
                            <div class="col">
                            <form action="{{ route('shed2.destroy', $datas->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                            </div>
                        </div>
                        
                       
                    </td> -->
                  
                </tr>
                <?php $old_weight=$datas->weight;?>
                @endforeach
        </tbody>
       
    </table>
   
			</div>
		</div>
	</div>
</div>

@endsection

