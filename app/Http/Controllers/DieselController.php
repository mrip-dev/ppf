<?php

namespace App\Http\Controllers;

use App\Models\Diesel;
use App\Models\Assets;
use Illuminate\Http\Request;

class DieselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {    
        $source_id='';
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $source=Assets::where('farm_id',$farm->id)->where('type','Diesel')->get();
        $query = Diesel::query();
        if($request->source_id){
            $source_id=$request->source_id;
            $query->where('source',$source_id);
        
        }
        
        $query->orderBy('date','asc')->where('farm_id',$farm->id)->with('aset');
        $data=$query->get();
        


        return view('modules.diesel.index', compact('data','source','source_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $source=Assets::where('farm_id',$farm->id)->where('type','Diesel')->get();
        return view('modules.diesel.add', compact('source','flock','farm'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        Diesel::create($request->all()+['farm_id' =>$farm->id,'session_id' => $flock->id]);
        return redirect()->route('diesel.index')
            ->with('success', 'Saved successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Diesel $shed1L)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $data=Diesel::find($id);
        $source=Assets::where('farm_id',$farm->id)->where('type','Diesel')->get();
        return view('modules.diesel.edit', compact('data','source'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
       
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $data=Diesel::find($id);
        $data->update($request->all());

        return redirect()->route('diesel.index')
            ->with('success', 'Updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=Diesel::find($id);
        $data->delete();

        return redirect()->route('diesel.index')
            ->with('success', 'Deleted successfully.');
    }
}
