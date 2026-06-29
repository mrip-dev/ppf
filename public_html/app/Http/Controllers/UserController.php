<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ProtienFarm;


class UserController extends Controller
{
    public function index(Request $request)
    {    
        $source_id='';
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $source=ProtienFarm::all();
        $query = User::query();
        if(auth()->user()->user_role!=4){
            $query->where('user_role','!=',4);
            $query->where('user_role','!=',1);
            $query->where('farm_id',$farm->id);
        }
        
        $query->orderBy('id','asc')->with('uType');
        $data=$query->get();
        


        return view('modules.users.index', compact('data','source'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $source=ProtienFarm::all();
        return view('modules.users.add', compact('source','flock','farm'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        User::create([
            
      
            'name' => $request->name,
            'user_role' => $request->user_role,
            'farm_id' => $request->farm_id,
            'email' => $request->email,
            'str_password' => $request->password,
            'password' => Hash::make($request->password),
           
        ]);
        return redirect()->route('users.index')
            ->with('success', 'Saved successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(users $shed1L)
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
        $data=User::find($id);
        $source=ProtienFarm::where('id',$farm->id)->get();
        return view('modules.users.edit', compact('data','source'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
       
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $data=User::find($id);
        $data->update($request->all());

        return redirect()->route('users.index')
            ->with('success', 'Updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=User::find($id);
        $data->delete();

        return redirect()->route('users.index')
            ->with('success', 'Deleted successfully.');
    }
}
