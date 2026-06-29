<?php

namespace App\Http\Controllers;

use App\Models\FarmSession;
use Illuminate\Http\Request;

class FarmSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $farm=$this->globalSetting();
        $data = FarmSession::where('farm_id',$farm->id)->get();

        return view('modules.session.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.session.add');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  
      
        $farm=$this->globalSetting();
        FarmSession::create($request->all()+['farm_id' => $farm->id]);
        return redirect()->route('session.index')
            ->with('success', 'Saved successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(FarmSession $shed1L)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=FarmSession::find($id);
        return view('modules.session.edit', compact('data'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
       
        $data=FarmSession::find($id);
        $data->update($request->all());

        return redirect()->route('session.index')
            ->with('success', 'Updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=FarmSession::find($id);
        $data->delete();

        return redirect()->route('session.index')
            ->with('success', 'Deleted successfully.');
    }
}
