<?php

namespace App\Http\Controllers;

use App\Models\Shed2R;
use App\Models\FeedInventory;
use Illuminate\Http\Request;

class Shed2RController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $data = Shed2R::where('farm_id',$farm->id)->where('session_id',$flock->id)->get();

        
        return view('modules.shed2.index', compact('data','farm'));
    }
    public function report()
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $data = Shed2R::where('farm_id',$farm->id)->where('session_id',$flock->id)->get();

       

        return view('modules.shed2.report', compact('data','farm','flock'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $farm=$this->globalSetting();
        return view('modules.shed2.add',compact('farm'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $amount=$request->day_feed+$request->night_feed;
        Shed2R::create($request->all());
        
        return redirect()->route('shed2.index')
            ->with('success', 'Saved successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Shed2R $shed2R)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=Shed2R::find($id);
        $farm=$this->globalSetting();
        return view('modules.shed2.edit', compact('data','farm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
       
        $data=Shed2R::find($id);
        $data->update($request->all());

        return redirect()->route('shed2.index')
            ->with('success', 'Updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=Shed2R::find($id);
        $data->delete();

        return redirect()->route('shed2.index')
            ->with('success', 'Deleted successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
  
}
