<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use Illuminate\Http\Request;

class AssetsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $data = Assets::orderBy('id','desc')->where('farm_id',$farm->id)->get();
        return view('modules.asset.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        return view('modules.asset.add');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        Assets::create($request->all()+['farm_id' =>$farm->id,'session_id' => $flock->id]);
        return redirect()->route('asset.index')
            ->with('success', 'Saved successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Assets $shed1L)
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
        $data=Assets::find($id);
        return view('modules.asset.edit', compact('data'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        
        $data=Assets::find($id);
        $data->update($request->all());

        return redirect()->route('asset.index')
            ->with('success', 'Updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=Assets::find($id);
        $data->delete();

        return redirect()->route('asset.index')
            ->with('success', 'Deleted successfully.');
    }
}
