<?php

namespace App\Http\Controllers;

use App\Models\HistoryKilometer;
use App\Models\Maintenance;
use App\Models\Part;
use App\Models\Quality;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MaintenanceController extends Controller
{
    public function tes()
    {
        $totalParts = Part::count();
        $totalVehicle = Vehicle::count();
        $totalQualities = Quality::count();
        $barangRusak = [];
        $maintenance = Maintenance::all();
        $parts = Part::all();
        $serviceTimes = HistoryKilometer::all();
        $vehicles = Vehicle::all();
        $qualities =  Quality::all();
        foreach ($maintenance as $item) {
            if ($item->quality_id == 3) { // Assuming quality_id 3 represents "bad" quality
                $barangRusak[] = $item;
            }
        }
        return view('tes.tes', compact('maintenance', 'parts', 'vehicles', 'qualities', 'totalParts', 'totalVehicle', 'totalQualities', 'barangRusak', 'serviceTimes'));
    }

    public function index()
    {
        $totalParts = Part::count();
        $totalVehicle = Vehicle::count();
        $totalQualities = Quality::count();
        $barangRusak = [];
        $maintenance = Maintenance::all();
        $parts = Part::all();
        $serviceTimes = HistoryKilometer::all();
        $vehicles = Vehicle::all();
        $qualities =  Quality::all();
        foreach ($maintenance as $item) {
            if ($item->quality_id == 3) { // Assuming quality_id 3 represents "bad" quality
                $barangRusak[] = $item;
            }
        }
        return view('maintenance', compact('maintenance', 'parts', 'vehicles', 'qualities', 'totalParts', 'totalVehicle', 'totalQualities', 'barangRusak', 'serviceTimes'));
    }

    public function create()
    {
        if (Auth::check()) {
            $parts = Part::all();
            $vehicles = Vehicle::all();
            $qualities =  Quality::all();
            // dd($vehicles);
            return view('maintenance.create', compact('parts', 'vehicles', 'qualities'));
        }
    }

    public function store(Request $request)
    {
        $maintenance = new Maintenance();
        $maintenance->part_id = $request->part_id;
        $maintenance->vehicle_id =  $request->vehicle_id;
        $maintenance->quality_id = $request->quality_id;
        $maintenance->description = $request->description;
        $maintenance->tanggal = Carbon::now(); // Example: "22 July 2023"
        $maintenance->createdBy = Auth::user()->name;
        if ($request->hasFile('file_image')) {
            $file = $request->file('file_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('foto_kondisi', $filename, 'public'); // Save the file to the 'public' disk under 'foto_kondisi' directory
            $maintenance->file_image = $filename;
        }

        $maintenance->save();

        // Fetch the damaged items based on quality_id 3 (assumed to be "bad" quality)
        $barangRusak = DB::table('maintenances')
            ->join('vehicles', 'maintenances.vehicle_id', '=', 'vehicles.id')
            ->join('parts', 'maintenances.part_id', '=', 'parts.id')
            ->where('maintenances.quality_id', 3)
            ->select('maintenances.*', 'vehicles.name as vehicle_name', 'parts.name as part_name')
            ->get();

        // Get all the records from HistoryKilometer model
        $serviceTimes = HistoryKilometer::all();

        // Filter the records to get only those with a non-null 'number' value
        $serviceTimesWithNumber = $serviceTimes->filter(function ($item) {
            return !empty($item->number) && !is_null($item->number);
        });

        // Assuming 'maintenances' is the related model for damaged items
        $barangRusak = Maintenance::where('quality_id', 3)->get();

        // Set the message based on the existence of damaged items
        $message = '';
        $vehicles = []; // Array to keep track of unique vehicle names

        $message .= '[ SISTEM OTOMATIS MESSAGE MAINTENANCE VEHICLE ]' . PHP_EOL;
        $message .= 'Salam sehat bapak/ ibu, izin memberitahukan bahwa:' . PHP_EOL;

        // Check if $barangRusak has data before adding it to the message
        if (count($barangRusak) > 0) {
            foreach ($barangRusak as $item) {
                // Check if the vehicle name is not already added to the list
                if (!in_array($item->vehicle_name, $vehicles)) {
                    $message .= '- ' . $item->vehicle_name . ' bagian ' . $item->part_name . PHP_EOL;
                    $vehicles[] = $item->vehicle_name; // Add the vehicle name to the list
                }
            }
        } else {
            $message .= '' . PHP_EOL;
        }

        // Check if $serviceTimesWithNumber has data before adding it to the message
        if (count($serviceTimesWithNumber) > 0) {
            foreach ($serviceTimesWithNumber as $item) {
                // Check if the vehicle name is not already added to the list
                if (!in_array($item->show_vehicle->name, $vehicles)) {
                    $message .= '- ' . $item->show_vehicle->name . ' - waktunya ganti oli atau servis rutin' . PHP_EOL;
                    $vehicles[] = $item->show_vehicle->name; // Add the vehicle name to the list
                }
            }
        } else {
            $message .= '' . PHP_EOL;
        }

        $message .= '' . PHP_EOL;
        $message .= 'Perlu dilakukan perbaikan' . PHP_EOL;
        $message .= '' . PHP_EOL;
        $message .= 'Informasi lebih lanjut silahkan cek pada website yang telah disediakan:' . PHP_EOL;
        $message .= '...' . PHP_EOL;
        $message .= '' . PHP_EOL;
        $message .= 'atau hubungi tim IT PT. Samudera Suri Surabaya';
        $message .= '' . PHP_EOL;
        $message .= 'atas perhatiannya kami ucapkan terimakasih';

        //check if the kilometer record needs to be moved to history
        if ($maintenance->quality_id == 3) {
            // Move the kilometer record to history_kilometers table
            $historyKilometer = new HistoryKilometer();
            // $historyKilometer->number = $maintenance->number;
            $historyKilometer->vehicle_id = $maintenance->vehicle_id;
            $historyKilometer->description = $maintenance->description;
            $historyKilometer->tanggal = $maintenance->tanggal;
            $historyKilometer->createdBy = $maintenance->createdBy;
            // $historyKilometer->service_time = $maintenance->service_time;
            // $kilometer->image = $request->image;
            $historyKilometer->image = $maintenance->file_image;

            $historyKilometer->save();

            //message BOT
            $token = 'BvJttHG86b_du_5gAaq2';
            $target = '6285755717626';

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $target,
                    'message' => $message,
                    'countryCode' => '62', //optional
                    'delay' => '5-10',
                ),
                CURLOPT_HTTPHEADER => array(
                    "Authorization: $token" //change TOKEN to your actual token
                ),
            ));
            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
            // dd($response);
        }

        return redirect()->route('maintenance.index')->with('success', 'Berhasil upload kondisi barang');
    }

    public function destroy(Maintenance $maintenance)
    {
        // Delete the file from the 'public' disk under 'foto_kondisi' directory
        if ($maintenance->file_image) {
            Storage::disk('public')->delete('foto_kondisi/' . $maintenance->file_image);
        }

        $maintenance->delete();

        return redirect()->route('maintenance.index')->with('success', 'Kondisi Barang Berhasil Dihapus');
    }
}
