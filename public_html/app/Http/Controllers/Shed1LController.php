<?php

namespace App\Http\Controllers;

use App\Models\Shed1L;
use App\Models\FeedInventory;
use Illuminate\Http\Request;
use Psy\Shell;

class Shed1LController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {           
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $data = Shed1L::where('farm_id',$farm->id)->where('session_id',$flock->id)->get();

        return view('modules.shed1.index', compact('data','farm'));
    }
    public function report()
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $data = Shed1L::where('farm_id',$farm->id)->where('session_id',$flock->id)->get();
        return view('modules.shed1.report', compact('data','flock','farm'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $farm=$this->globalSetting();
        return view('modules.shed1.add',compact('farm'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         
          $oldvalue=1;
          $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $oldvaluerow=Shed1L::where('farm_id',$farm->id)->where('session_id',$flock->id)->orderBy('id','desc')->first();

        if($oldvaluerow){
            $oldvalue=$oldvaluerow->weight;
        }
        $amount=$request->day_feed+$request->night_feed;
     
        if($request->weight==NULL or $request->weight=='' ){
            $request->merge(['weight' => $oldvalue]);
        }
        Shed1L::create($request->all());
       
        return redirect()->route('shed1.index')
            ->with('success', 'Saved successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Shed1L $shed1L)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=Shed1L::find($id);
        $farm=$this->globalSetting();
        return view('modules.shed1.edit', compact('data','farm'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
       
        $data=Shed1L::find($id);
        $data->update($request->all());

        return redirect()->route('shed1.index')
            ->with('success', 'Updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shed1L $shed1)
    {
        $shed1->delete();

        return redirect()->route('shed1.index')
            ->with('success', 'Deleted successfully.');
    }
}
