<?php

namespace App\Http\Controllers;

use App\Models\Management;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $farm=$this->globalSetting();
        $data = Management::orderBy('id','desc')->where('farm_id',$farm->id)->get();


        return view('modules.management.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $farm=$this->globalSetting();

        
        return view('modules.management.add');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $farm=$this->globalSetting();

        Management::create($request->all()+['farm_id' =>$farm->id]);
        return redirect()->route('management.index')
            ->with('success', 'Saved successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Management $shed1L)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=Management::find($id);
        

        return view('modules.management.edit', compact('data'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
       
        $data=Management::find($id);
        $data->update($request->all());

        return redirect()->route('management.index')
            ->with('success', 'Updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=Management::find($id);
        $data->delete();

        return redirect()->route('management.index')
            ->with('success', 'Deleted successfully.');
    }
}
