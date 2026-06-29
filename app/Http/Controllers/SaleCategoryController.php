<?php

namespace App\Http\Controllers;

use App\Models\SaleCategory;
use Illuminate\Http\Request;

class SaleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $data = SaleCategory::orderBy('id','desc')->where('farm_id',$farm->id)->get();
        return view('modules.category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        return view('modules.category.add');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        SaleCategory::create($request->all()+['farm_id' =>$farm->id,'session_id' => $flock->id]);
        return redirect()->route('category.index')
            ->with('success', 'Saved successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(SaleCategory $shed1L)
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
        $data=SaleCategory::find($id);
        return view('modules.category.edit', compact('data'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        
        $data=SaleCategory::find($id);
        $data->update($request->all());

        return redirect()->route('category.index')
            ->with('success', 'Updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=SaleCategory::find($id);
        $data->delete();

        return redirect()->route('category.index')
            ->with('success', 'Deleted successfully.');
    }
}
