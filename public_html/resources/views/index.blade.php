@extends('layout.layout')

@section('content')

<?php


$activeflock=App\Http\Controllers\Controller::myFlock();
$dashboard=App\Http\Controllers\Controller::dashboard();
$medicines=App\Http\Controllers\MedicineController::allmeds();


?>            @if(!$activeflock)
              <div class="col-12 layout-spacing p-4  m-4">
                <div class="alert alert-danger">
                  Flock is not activated yet!  <a href="{{ route('farm.edit', auth()->user()->farm_id) }}" class="btn btn-primary">Please activate Flock</a>
                </div>
              </div>
              @endif
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-card-five">
                                <div class="widget-content">
                                    <div class="account-box">

                                        <div class="info-box">
                                            <div class="icon">
                                                <span>
                                                    <img src="images/feed.png" alt="money-bag">
                                                </span>
                                            </div>

                                            <div class="balance-info">
                                                <h6>Available Feed</h6>
                                                <p>{{$dashboard['Feed']}} Bags</p>
                                            </div>
                                        </div>

                                        <div class="card-bottom-section">
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card one end  -->
                         <!-- Card two start -->
                         <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-card-five">
                                <div class="widget-content">
                                    <div class="account-box">

                                        <div class="info-box">
                                            <div class="icon">
                                                <span>
                                                    <img src="images/diesel.png" alt="money-bag">
                                                </span>
                                            </div>

                                            <div class="balance-info">
                                                <h6>Available Diesel</h6>
                                                <p>{{$dashboard['diesel']}} Litres</p>
                                            </div>
                                        </div>

                                        <div class="card-bottom-section">
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card two end  -->

                   

                           

                   



                       

                        
                       <!-- //////////////  End of card  -->


                       
                            <!-- Card four start -->
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-card-five">
                                <div class="widget-content">
                                    <div class="account-box">

                                        <div class="info-box">
                                            <div class="icon">
                                                <span>
                                                    <img src="images/wood.png" alt="money-bag">
                                                </span>
                                            </div>

                                            <div class="balance-info">
                                                <h6>Available Wood</h6>
                                                <p>{{$dashboard['wood']}}</p>
                                            </div>
                                        </div>

                                        <div class="card-bottom-section">
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card three end  -->

                   
 <!-- Card three start -->
                         <div class="col-12 layout-spacing">
                            <div class="widget widget-card-five">
                                <div class="widget-content">
                                    <div class="account-box">

                                        <div class="info-box">
                                            <div class="icon text-center">
                                                <span>
                                                    <img src="images/med.png" alt="money-bag">
                                                </span>
                                            </div>

                                            <div class="balance-info">
                                                <h2 class="text-center">Medicine Summary</h2>
                                                <table id="zero-config" class="table">
				
                <thead>
               <tr>
                   <th>ID</th>
                   <th>Medicine Name</th>
                   <th>Received</th>
                   <th>Consumed</th>
                   <th>Stock</th>
                  
               </tr>
           </thead>
           <tbody>
                  @foreach($medicines as $medi)
                   <tr>
                      <td>{{$medi->id}}</td>
                      <td>{{$medi->name}}</td>
                      <?php 
                         $medicine=App\Http\Controllers\Controller::getMedicine($medi->id);
                      ?>
                      <td>{{$medicine['mediciner']}}</td>
                      <td>{{$medicine['medicinec']}}</td>
                      <td>{{$medicine['medicine']}}</td>
          
                   </tr>
                   @endforeach
           </tbody>
          
       </table>
                                            </div>
                                        </div>

                                        <div class="card-bottom-section">
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <!-- card three end  -->


                       

                        
                       <!-- //////////////  End of card  -->

                       @endsection




















