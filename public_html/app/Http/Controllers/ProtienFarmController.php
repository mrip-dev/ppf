<?php

namespace App\Http\Controllers;

use App\Models\ProtienFarm;
use App\Models\FarmSession;
use Illuminate\Http\Request;

class ProtienFarmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ProtienFarm::orderBy('id','desc')->with('tender')->get();


        return view('modules.farm.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $farm=$this->globalSetting();
        $sess = FarmSession::where('farm_id',$farm->id)->get();
        
        return view('modules.farm.add', compact('sess'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        ProtienFarm::create($request->all());
        return redirect()->route('farm.index')
            ->with('success', 'Saved successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(ProtienFarm $shed1L)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=ProtienFarm::find($id);
        $sess = FarmSession::where('farm_id',$data->id)->get();

        return view('modules.farm.edit', compact('data','sess'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
       
        $data=ProtienFarm::find($id);
        $data->update($request->all());

        return redirect()->route('farm.index')
            ->with('success', 'Updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=ProtienFarm::find($id);
        $data->delete();

        return redirect()->route('farm.index')
            ->with('success', 'Deleted successfully.');
    }
}
