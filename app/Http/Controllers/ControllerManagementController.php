<?php

namespace App\Http\Controllers;

use App\Models\ControllerManagement;
use GuzzleHttp\Client;
use App\Models\CNStatus;
use App\Models\CNRecord;
use App\Models\esp32_table_dht11_leds_update;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class ControllerManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
    /**
     * Show the form for creating a new resource.
     */
  
public function chunkWiseData(Request $request)
{
    // Retrieve global settings, assuming this method returns necessary information
    $farm = $this->globalSetting();
    $device_id=$farm->device_id_shed1;
    // Retrieve the last 50 records ordered by date and time
    $columns = \Schema::getColumnListing('esp32_table_dht11_leds_record');
    $columns[] = \DB::raw('id as custom_id');
    $records = CNRecord::orderby('date', 'desc')->orderby('time', 'desc')->where('board',$device_id)->select($columns)->get();
  
    // Initialize an empty array to store filtered records
    $filteredRecords = [];

    // Initialize a variable to keep track of the last included record's timestamp
    $lastIncludedTimestamp = null;

    foreach ($records as $record) {
        // Combine date and time into a single Carbon instance
        $currentTimestamp = Carbon::createFromFormat('Y-m-d H:i:s', $record->date . ' ' . $record->time);

        // If it's the first record or at least 10 minutes have passed since the last included record
        if ($lastIncludedTimestamp === null || $currentTimestamp->diffInMinutes($lastIncludedTimestamp) >= 10) {
            // Add the record to the filtered records array
            $filteredRecords[]= $record;
        
            // Update the last included timestamp
            $lastIncludedTimestamp = $currentTimestamp;
        }
    }
   
    // Return the filtered records as a JSON response
    return view('modules.cr1.index', ['records' => $filteredRecords]);
}

    public function index()
    {   $farm=$this->globalSetting();
        // $data = DB::table('esp32_table_dht11_leds_update')->latest()->first();

        return view('modules.controller-management.index');
    }
    
    public function fetchData(Request $request)
    {    $farm=$this->globalSetting();
        $device_id=$farm->device_id_shed1;

        $data=CNStatus::orderby('date','desc')->orderby('time','desc')->where('device_id',$device_id)->first();
        return response()->json(['data' => $data]);
    }
 
    public function updateStatus(Request $request){

        $data=CNStatus::where('device_id',$request->id);
        $data->update($request->all());
        return response()->json(['data' => $data,'message' => 'Success']);
    }
    // public function updateStatus(Request $request)
    // {
    //     // Fetch all data from the database
    //     $temperature=$request->temperature;
    //     $humidity=$request->humidity;
    //     $LED_01=$request->LED_01;
    //     $LED_02=$request->LED_02;
    //     $status_read_sensor_dht11=$request->status_read_sensor_dht11;
    //     $data=DB::table('esp32_table_dht11_leds_update')
    //     ->where('id', 1)  // find your user by their email
    //     ->update(array('temperature' => $temperature,'humidity' => $humidity,'LED_01' => $LED_01,'LED_02' => $LED_02,'status_read_sensor_dht11' => $status_read_sensor_dht11));  // update the record in the DB. 
       

    //     return response()->json(['data' => $data,'message' => 'Success']);
    // }
    // public function getWeather()
    // {
    //     // Replace 'YOUR_OPENWEATHERMAP_API_KEY' with your actual API key
    //     $apiKey = 'a31639d7f41e80b501155b257b46f8da';
    //     $city = 'Renala Khurd';
    //     $countryCode = 'PK';
    //     $units = 'metric'; // You can change this to 'imperial' for Fahrenheit

    //     $client = new Client();
    //     $response = $client->get("https://api.openweathermap.org/data/2.5/weather?q={$city},{$countryCode}&units={$units}&appid={$apiKey}");

    //     if ($response->getStatusCode() === 200) {
    //         $data = json_decode($response->getBody()->getContents(), true);

    //         $temperature = $data['main']['temp'];
    //         $humidity = $data['main']['humidity'];

    //         return response()->json([
    //             'temperature' => $temperature,
    //             'humidity' => $humidity
    //         ]);
    //     }

    //     return response()->json(['error' => 'Failed to fetch weather data'], 500);
    // }
   
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ControllerManagement $controllerManagement)
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
        $data=CNStatus::find($id);
        return view('modules.controller-management.edit', compact('data'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
       
        $flock=$this->activeFlock();
        $farm=$this->globalSetting();
        $data=CNStatus::find($id);
        $data->update($request->all());

        return view('modules.controller-management.index', compact('data'))
            ->with('success', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delRecord($id)
   
    {
        // Find the record by ID
        $record = CNRecord::findOrFail($id);

        // Delete the record
        $record->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Record deleted successfully.');
    }
}