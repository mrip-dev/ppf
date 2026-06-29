<?php

namespace App\Http\Controllers;

use App\Models\StdHouse2;
use App\Models\FlockStandard;
use Illuminate\Http\Request;

class StdHouse2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $data = FlockStandard::orderBy('day','asc')->where('farm_id',$farm->id)->get();

        return view('modules.std2.index', compact('data'));
    }
   
    public function report()
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $data = StdHouse2::orderBy('day','asc')->where('farm_id',$farm->id)->get();

        return view('modules.std-house2.report', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        return view('modules.std-house2.add');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        StdHouse2::create($request->all()+['farm_id' =>$farm->id,'session_id' => $flock->id]);
        return redirect()->route('std-house2.index')
            ->with('success', 'Saved successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(StdHouse2 $StdHouse2)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=StdHouse2::find($id);
        return view('modules.std-house2.edit', compact('data'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
       
        $data=StdHouse2::find($id);
        $data->update($request->all());

        return redirect()->route('std-house2.index')
            ->with('success', 'Updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=StdHouse2::find($id);
        $data->delete();

        return redirect()->route('std-house2.index')
            ->with('success', 'Deleted successfully.');
    }

}
