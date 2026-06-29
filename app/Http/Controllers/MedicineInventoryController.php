<?php

namespace App\Http\Controllers;

use App\Models\MedicineInventory;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $data = MedicineInventory::orderBy('id','asc')->with('medicine')->where('farm_id',$farm->id)->get();


        return view('modules.medicine-inventory.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $medicine= $data = Medicine::orderBy('id','asc')->where('farm_id',$farm->id)->get();
        return view('modules.medicine-inventory.add', compact('medicine'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $total_amount=$request->amount;
        if($request->shed1_amount){
            $total_amount=$request->shed1_amount+$request->shed2_amount;
        }
        $request->merge(['amount' =>  $total_amount]);
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        MedicineInventory::create($request->all()+['farm_id' =>$farm->id,'session_id' => $flock->id]);
 
        return redirect()->route('medicine-inventory.index')
            ->with('success', 'Saved successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(MedicineInventory $shed1L)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=MedicineInventory::find($id);
        return view('modules.medicine-inventory.edit', compact('data'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
       
        $data=MedicineInventory::find($id);
        $data->update($request->all());

        return redirect()->route('medicine-inventory.index')
            ->with('success', 'Updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=MedicineInventory::find($id);
        $data->delete();

        return redirect()->route('medicine-inventory.index')
            ->with('success', 'Deleted successfully.');
    }
}
