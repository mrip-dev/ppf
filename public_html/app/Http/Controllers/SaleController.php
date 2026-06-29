<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\GatePass;
use App\Models\SaleCategory;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $farm=$this->globalSetting();
        $data = GatePass::orderBy('id','desc')->where('farm_id',$farm->id)->get();


        return view('modules.sale.index', compact('data','farm'));
    }
    public function allSales(Request $request)
    {   $farm=$this->globalSetting();
        $type=$request->type;
        $data = Sale::orderBy('id','desc')->where('farm_id',$farm->id)->where('pass_id',$request->id)->get();


        return view('modules.sale.index-sales', compact('data','farm','type'));
    }
    public function print(Request $request)
    {   $farm=$this->globalSetting();
        $type=$request->type;
        $id=$request->id;
        $data = Sale::orderBy('id','desc')->where('farm_id',$farm->id)->where('pass_id',$request->id)->get();


        return view('modules.sale.index-print', compact('data','farm','type','id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $source=SaleCategory::where('farm_id',$farm->id)->get();
        
        return view('modules.sale.add',compact('source'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $farm=$this->globalSetting();
        $GatePass=GatePass::create([
            
            'type' => $request->type,
            'farm_id' =>$farm->id
        ]);
        $i=0;
        foreach($request->spec_name as $spname){
            Sale::create([
                'farm_id' =>$farm->id,
                'pass_id' =>$GatePass->id,
                'spec_name' => $request->spec_name[$i],
                'specs' => $request->specs[$i],
                'unit' => $request->unit[$i],
                'from' => $request->from[$i],
                'bill_no' => $request->bill_no[$i],
                'category' => $request->category[$i],
                'driver' => $request->driver[$i],
                'price' => $request->price[$i],
                // 'doc_no' => $request->doc_no[$i],
                'amount' => $request->amount[$i],
               'quantity' => $request->quantity[$i]
                
                
            ]);
            $i++;

        }
        
        return redirect()->route('sale.index')
            ->with('success', 'Saved successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Sale $shed1L)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data=Sale::find($id);
        

        return view('modules.sale.edit', compact('data'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
       
        $data=Sale::find($id);
        $data->update($request->all());

        return redirect()->route('sale.index')
            ->with('success', 'Updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=Sale::delete($id);
        

        return redirect()->route('sale.index')
            ->with('success', 'Deleted successfully.');
    }
}
