<?php

namespace App\Http\Controllers;

use App\Models\Wood;
use App\Models\Assets;
use Illuminate\Http\Request;

class WoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {  
          $source_id='';
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $source=Assets::where('farm_id',$farm->id)->where('type','Wood')->get();
        $query = Wood::query();
        if($request->source_id){
            $source_id=$request->source_id;
            $query->where('source',$source_id);
        
        }
        
        $query->orderBy('date','asc')->where('farm_id',$farm->id)->with('aset');
        $data=$query->get();
        

        return view('modules.wood.index',  compact('data','source','source_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $source=Assets::where('farm_id',$farm->id)->where('type','Wood')->get();
        return view('modules.wood.add', compact('source','flock','farm'));
       
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        Wood::create($request->all()+['farm_id' =>$farm->id,'session_id' => $flock->id]);
     
        return redirect()->route('wood.index')
            ->with('success', 'Saved successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Wood $shed1L)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=Wood::find($id);
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $source=Assets::where('farm_id',$farm->id)->where('type','Wood')->get();
        return view('modules.wood.edit', compact('data','source'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
       
        $data=Wood::find($id);
        $data->update($request->all());

        return redirect()->route('wood.index')
            ->with('success', 'Updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=Wood::find($id);
        $data->delete();

        return redirect()->route('wood.index')
            ->with('success', 'Deleted successfully.');
    }
}
