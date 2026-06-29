<?php

namespace App\Http\Controllers;

use App\Models\FeedInventory;
use Illuminate\Http\Request;

class FeedInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $data = FeedInventory::orderBy('id','desc')->where('farm_id',$farm->id)->get();

        return view('modules.feed-inventory.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        return view('modules.feed-inventory.add');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $total_amount=$request->amount;
        if($request->shed1_amount){
            $total_amount=$request->shed1_amount+$request->shed2_amount;
        }
        $request->merge(['amount' =>  $total_amount]);
        FeedInventory::create($request->all()+['farm_id' =>$farm->id,'session_id' => $flock->id]);
        return redirect()->route('feed-inventory.index')
            ->with('success', 'Saved successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(FeedInventory $shed1L)
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
        $data=FeedInventory::find($id);
        return view('modules.feed-inventory.edit', compact('data'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
       
        $data=FeedInventory::find($id);
        $data->update($request->all());

        return redirect()->route('feed-inventory.index')
            ->with('success', 'Updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=FeedInventory::find($id);
        $data->delete();

        return redirect()->route('feed-inventory.index')
            ->with('success', 'Deleted successfully.');
    }
}
