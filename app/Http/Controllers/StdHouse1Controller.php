<?php

namespace App\Http\Controllers;

use App\Models\FlockStandard;
use Illuminate\Http\Request;

class StdHouse1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $data = FlockStandard::orderBy('day','asc')->where('farm_id',$farm->id)->get();

        return view('modules.std1.index', compact('data'));
    }
   

}
