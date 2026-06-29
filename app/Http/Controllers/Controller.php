<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\FarmSession;
use App\Models\ProtienFarm;
use App\Models\Wood;
use App\Models\Shed1L;
use App\Models\Shed2R;
use Auth;
use Illuminate\Http\Request;
use App\Models\Diesel;
use App\Models\FeedInventory;
use App\Models\MedicineInventory;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function globalSetting(){
      $id=Auth::user()->farm_id;
      $data=ProtienFarm::find($id);
      return $data;
    }
    public static function globalSettingStatic(){
      $id=Auth::user()->farm_id;
      $data=ProtienFarm::find($id);
      return $data;
    }
    public function activeFlock(){
      $farm=$this->globalSetting();
      $data=FarmSession::find( $farm->active_session);
      return $data;
    }
    public static function myFlock(){
      $id=Auth::user()->farm_id;
      $farm=ProtienFarm::find($id);
      if(!$farm){
        Auth::guard('web')->logout();
 
        return redirect('/');
      }
      $data=FarmSession::find( $farm->active_session);
      return $data;
    }
    public function logout(Request $request)
{
    Auth::guard('web')->logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/');
}
    
    
    public static function dashboard(){
       $data=[];
       $farm_id=Auth::user()->farm_id;
       $farm=ProtienFarm::find($farm_id);
       $data=FarmSession::find($farm->active_session ?? '');
      
       $session_id=$data->id ?? 0;
       $rwood= Wood::where('type','Received')->where('farm_id',$farm_id)->sum('amount');
       $cwood= Wood::where('type','Consumed')->where('farm_id',$farm_id)->sum('amount');

       $data['wood']=$rwood-$cwood;
       $rDiesel= Diesel::where('type','Received')->where('farm_id',$farm_id)->sum('amount');
       $cDiesel1= Diesel::where('type','Consumed')->where('farm_id',$farm_id)->sum('consumption_shed1');
       $cDiesel2= Diesel::where('type','Consumed')->where('farm_id',$farm_id)->sum('consumption_shed2');
       $cDiesel3= Diesel::where('type','Consumed')->where('farm_id',$farm_id)->sum('consumption_generator');
             $cDiesel=$cDiesel1+$cDiesel2+$cDiesel3;
       $data['diesel']=$rDiesel-$cDiesel;

       $Feed1= Shed1L::where('farm_id',$farm_id)->sum('feed_recieved');
       $Feed2= Shed2R::where('farm_id',$farm_id)->sum('feed_recieved');
       $dFeed1= Shed1L::where('farm_id',$farm_id)->sum('day_feed');
       $nFeed1= Shed1L::where('farm_id',$farm_id)->sum('night_feed');
       $nFeed2= Shed2R::where('farm_id',$farm_id)->sum('night_feed');
       $dFeed2= Shed2R::where('farm_id',$farm_id)->sum('day_feed');
       $rFeed=$Feed1+$Feed2;
       $cFeed=$dFeed1+$dFeed2+$nFeed1+$nFeed2;
       $data['Feed']=$rFeed-$cFeed;
      
      return $data;
    }
    public static function getMedicine($id){
      $farm_id=Auth::user()->farm_id;
      $farm=ProtienFarm::find($farm_id);
      $rmedicine= MedicineInventory::where('type','Received')->where('farm_id',$farm_id)->where('item_id',$id)->sum('amount');
      $cmedicine= MedicineInventory::where('type','Consumed')->where('farm_id',$farm_id)->where('item_id',$id)->sum('amount');

      $data['mediciner']=$rmedicine;
      $data['medicinec']=$cmedicine;
      $data['medicine']=$rmedicine-$cmedicine;
      return $data;
    }
    public static function getFeedUsedByAge($age){
      $total_f=0;
      $total_m=0;
      $total_b=0;
      $total=[];
      $farm_id=Auth::user()->farm_id;
      $farm=ProtienFarm::find($farm_id);
      $usedfeed= Shed1L::where('farm_id',$farm_id)->where('session_id',$farm->active_session)->where('age',$age)->first();
      $session=FarmSession::find($farm->active_session);
      if($session){
        $total_b=$session->str_shed1;
        
       }
     if($usedfeed){
      $total_f=$usedfeed->day_feed+$usedfeed->night_feed;
      $total_m=$usedfeed->day_mor+$usedfeed->night_mor;
      
     }
     $total['f']=$total_f;
     $total['m']=$total_m;
     $total['b']=$total_b;
      return $total;
    }
    public static function getFeedUsedByAge2($age){
      $total_f=0;
      $total_m=0;
      $total_b=0;
      $total=[];
      $farm_id=Auth::user()->farm_id;
      $farm=ProtienFarm::find($farm_id);
      $usedfeed= Shed2R::where('farm_id',$farm_id)->where('session_id',$farm->active_session)->where('age',$age)->first();
      $session=FarmSession::find($farm->active_session);
      if($session){
        $total_b=$session->str_shed2;
        
       }
     if($usedfeed){
      $total_f=$usedfeed->day_feed+$usedfeed->night_feed;
      $total_m=$usedfeed->day_mor+$usedfeed->night_mor;
      
     }
     $total['f']=$total_f;
     $total['m']=$total_m;
     $total['b']=$total_b;
      return $total;
    }
  //   public static function dashboard(){
  //     $data=[];
  //     $farm_id=1;
  //     $farm=ProtienFarm::find($farm_id);
  //     $data=FarmSession::find($farm->active_session ?? '');
     
  //     $session_id=$data->id ?? 0;ere('se
  //     $rwood= Wood::where('type','Received')->whssion_id',$session_id)->where('farm_id',$farm_id)->sum('amount');
  //     $cwood= Wood::where('type','Consumed')->where('session_id',$session_id)->where('farm_id',$farm_id)->sum('amount');

  //     $data['wood']=$rwood-$cwood;
  //     $rDiesel= Diesel::where('type','Received')->where('session_id',$session_id)->where('farm_id',$farm_id)->sum('amount');
  //     $cDiesel= Diesel::where('type','Consumed')->where('session_id',$session_id)->where('farm_id',$farm_id)->sum('amount');

  //     $data['diesel']=$rDiesel-$cDiesel;

  //     $rFeed= FeedInventory::where('type','Received')->where('session_id',$session_id)->where('farm_id',$farm_id)->sum('amount');
  //     $cFeed= FeedInventory::where('type','Consumed')->where('session_id',$session_id)->where('farm_id',$farm_id)->sum('amount');

  //     $data['Feed']=$rFeed-$cFeed;
  //     $rmedicine= MedicineInventory::where('type','Received')->where('session_id',$session_id)->where('farm_id',$farm_id)->sum('amount');
  //     $cmedicine= MedicineInventory::where('type','Consumed')->where('session_id',$session_id)->where('farm_id',$farm_id)->sum('amount');

  //     $data['medicine']=$rmedicine-$cmedicine;
  //    return $data;
  //  }
}
