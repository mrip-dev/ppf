<?php

namespace App\Http\Controllers;

use App\Models\FlockStandard;
use Illuminate\Http\Request;

class FlockStandardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $data = FlockStandard::orderBy('day','asc')->where('farm_id',$farm->id)->get();

        return view('modules.flock-standard.index', compact('data'));
    }
    public function report()
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $data = FlockStandard::orderBy('day','asc')->where('farm_id',$farm->id)->get();

        return view('modules.flock-standard.report', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        return view('modules.flock-standard.add');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        FlockStandard::create($request->all()+['farm_id' =>$farm->id,'session_id' => $flock->id]);
        return redirect()->route('flock-standard.index')
            ->with('success', 'Saved successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(FlockStandard $FlockStandard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=FlockStandard::find($id);
        return view('modules.flock-standard.edit', compact('data'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
       
        $data=FlockStandard::find($id);
        $data->update($request->all());

        return redirect()->route('flock-standard.index')
            ->with('success', 'Updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=FlockStandard::find($id);
        $data->delete();

        return redirect()->route('flock-standard.index')
            ->with('success', 'Deleted successfully.');
    }
}
