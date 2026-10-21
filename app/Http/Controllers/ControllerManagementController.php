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
use App\Jobs\ExportCnRecordsJob;
use App\Models\ExportRequest;
use Illuminate\Support\Facades\Storage;


class ControllerManagementController extends Controller
{


    public function exportRequest(Request $request)
    {
        $data = $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        $farm = $this->globalSetting();

        $export = ExportRequest::create([
            'user_id'    => auth()->id(),
            'device_id'  => $farm->device_id_shed1,
            'start_date' => $data['start_date'],
            'end_date'   => $data['end_date'],
        ]);

        ExportCnRecordsJob::dispatch($export->id);

        return back()->with('success', "Export #{$export->id} started. You can download it below once it is ready.");
    }

    public function exportStatus()
    {
        $farm = $this->globalSetting();   // <-- this line was missing

        $exports = ExportRequest::where('user_id', auth()->id())
            ->where('device_id', $farm->device_id_shed1)
            ->latest()->limit(10)->get()
            ->map(fn($e) => [
                'id'       => $e->id,
                'range'    => $e->start_date->toDateString() . ' → ' . $e->end_date->toDateString(),
                'status'   => $e->status,
                'progress' => $e->progress,
                'rows'     => $e->processed_rows,
                'error'    => $e->error,
                'download' => $e->status === 'completed' ? url('/cr1/export/' . $e->id . '/download') : null,
            ]);

        return response()->json($exports);
    }

    public function exportDownload($id)
    {
        $farm = $this->globalSetting();   // <-- needed here too

        $export = ExportRequest::where('user_id', auth()->id())
            ->where('device_id', $farm->device_id_shed1)
            ->where('status', 'completed')
            ->findOrFail($id);

        abort_unless(Storage::disk('local')->exists($export->file_path), 404);

        return Storage::disk('local')->download($export->file_path);
    }















    /**
     * Display a listing of the resource.
     */

    /**
     * Show the form for creating a new resource.
     */

    public function chunkWiseData(Request $request)
    {
        $farm = $this->globalSetting();
        $device_id = $farm->device_id_shed1;

        $columns = \Schema::getColumnListing('esp32_table_dht11_leds_record');

        // Latest id per 10-minute bucket, limited to the newest 500 buckets
        $latestIds = CNRecord::query()
            ->where('board', $device_id)
            ->where('date', '>=', now()->subDays(3)->toDateString()) // narrows the scan, big speedup
            ->selectRaw('MAX(id) as id')
            ->groupByRaw('UNIX_TIMESTAMP(TIMESTAMP(`date`, `time`)) DIV 600')
            ->orderByDesc('id')
            ->limit(500);

        $records = CNRecord::query()
            ->select($columns)
            ->addSelect('id as custom_id')
            ->whereIn('id', function ($q) use ($latestIds) {
                $q->fromSub($latestIds, 't')->select('t.id');
            })
            ->orderByDesc('date')
            ->orderByDesc('time')
            ->get();

        return view('modules.cr1.index', ['records' => $records]);
    }

    public function index()
    {
        $farm = $this->globalSetting();
        // $data = DB::table('esp32_table_dht11_leds_update')->latest()->first();

        return view('modules.controller-management.index');
    }

    public function fetchData(Request $request)
    {
        $farm = $this->globalSetting();
        $device_id = $farm->device_id_shed1;

        $data = CNStatus::orderby('date', 'desc')->orderby('time', 'desc')->where('device_id', $device_id)->first();
        return response()->json(['data' => $data]);
    }

    public function updateStatus(Request $request)
    {

        $data = CNStatus::where('device_id', $request->id);
        $data->update($request->all());
        return response()->json(['data' => $data, 'message' => 'Success']);
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
        $flock = $this->activeFlock();
        $farm = $this->globalSetting();
        $data = CNStatus::find($id);
        return view('modules.controller-management.edit', compact('data'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $flock = $this->activeFlock();
        $farm = $this->globalSetting();
        $data = CNStatus::find($id);
        $data->update(array_merge($request->all(), [
            'save' => 1,
        ]));

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
