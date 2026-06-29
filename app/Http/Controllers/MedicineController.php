<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Auth;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $data = Medicine::orderBy('id','asc')->where('farm_id',$farm->id)->get();
        

        return view('modules.medicine.index', compact('data'));
    }
    public static function allmeds()
    {
        $id=Auth::user()->farm_id;
      
     
        $data = Medicine::orderBy('id','asc')->where('farm_id',$id)->get();
        

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.medicine.add');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        Medicine::create($request->all()+['farm_id' =>$farm->id,'session_id' => $flock->id]);
        return redirect()->route('medicine.index')
            ->with('success', 'Saved successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Medicine $shed1L)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=Medicine::find($id);
        return view('modules.medicine.edit', compact('data'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
       
        $data=Medicine::find($id);
        $data->update($request->all());

        return redirect()->route('medicine.index')
            ->with('success', 'Updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=Medicine::find($id);
        $data->delete();

        return redirect()->route('medicine.index')
            ->with('success', 'Deleted successfully.');
    }
}
