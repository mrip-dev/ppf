<?php

namespace App\Http\Controllers;

use App\Models\Management2;
use Illuminate\Http\Request;

class Management2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $farm=$this->globalSetting();
        $data = Management2::orderBy('id','desc')->where('farm_id',$farm->id)->get();


        return view('modules.management2.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $farm=$this->globalSetting();

        
        return view('modules.management2.add');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $farm=$this->globalSetting();

        Management2::create($request->all()+['farm_id' =>$farm->id]);
        return redirect()->route('management2.index')
            ->with('success', 'Saved successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Management2 $shed1L)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=Management2::find($id);
        

        return view('modules.management2.edit', compact('data'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
       
        $data=Management2::find($id);
        $data->update($request->all());

        return redirect()->route('management2.index')
            ->with('success', 'Updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=Management2::find($id);
        $data->delete();

        return redirect()->route('management2.index')
            ->with('success', 'Deleted successfully.');
    }
}
