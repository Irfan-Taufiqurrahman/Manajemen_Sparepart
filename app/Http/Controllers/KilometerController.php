<?php

namespace App\Http\Controllers;

use App\Models\HistoryKilometer;
use App\Models\Kilometer;
use App\Models\Maintenance;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KilometerController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $kilometers = Kilometer::all();
            $vehicle = Vehicle::all();
            $serviceTimes = HistoryKilometer::all();
            return view('Kilometer.kilometer', compact('kilometers', 'vehicle', 'serviceTimes'));
        }
    }

    public function create()
    {
        if (Auth::check()) {
            $vehicle = Vehicle::all();
            return view('kilometer.create', compact('vehicle'));
        }
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'number' => 'required|numeric',
        ]);

        // Remove commas from the 'number' input
        $number = str_replace(',', '', $request->input('number'));

        $kilometer = new Kilometer();
        $kilometer->number = $number; // Assign the cleaned number value
        $kilometer->vehicle_id = $request->vehicle_id;
        $kilometer->description = $request->description;
        $kilometer->tanggal = Carbon::now(); // Example: "22 July 2023"
        $kilometer->createdBy = Auth::user()->name;
        // Calculate service time based on the previous entry's kilometer
        $serviceTime = 'no';
        $previousKilometer = Kilometer::where('vehicle_id', $request->vehicle_id)->orderBy('tanggal', 'desc')->first();

        if ($previousKilometer && $kilometer->number >= $previousKilometer->number + 10000) {
            $serviceTime = 'yes';
        }

        $kilometer->service_time = $serviceTime;

        // $kilometer->image = $request->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('foto_kondisi', $filename, 'public'); // Save the file to the 'public' disk under 'foto_kondisi' directory
            $kilometer->image = $filename;
        }
        $kilometer->save();

        // $maintenance = new Maintenance();
        // Fetch the damaged items based on quality_id 3 (assumed to be "bad" quality)
        $barangRusak = DB::table('maintenances')
            ->join('vehicles', 'maintenances.vehicle_id', '=', 'vehicles.id')
            ->join('parts', 'maintenances.part_id', '=', 'parts.id')
            ->where('maintenances.quality_id', 3)
            ->select('maintenances.*', 'vehicles.name as vehicle_name', 'parts.name as part_name')
            ->get();

        // $serviceTimesWithNumber = new HistoryKilometer();
        $serviceTimesWithNumber = HistoryKilometer::whereNotNull('number')->get();

        // Set the message based on the existence of damaged items
        $messages = '';

        $messages .= '[ SISTEM OTOMATIS MESSAGE MAINTENANCE VEHICLE ]' . PHP_EOL;
        $messages .= 'Salam sehat bapak/ ibu, izin memberitahukan bahwa : ' . PHP_EOL;

        // Check if $barangRusak has data before adding it to the message
        if (count($barangRusak) > 0) {
            foreach ($barangRusak as $item) {
                $messages .= '- ' . $item->vehicle_name . ' bagian ' . $item->part_name . PHP_EOL;
            }
        } else {
            $messages .= '' . PHP_EOL;
        }

        // Check if $serviceTimesWithNumber has data before adding it to the message
        if ($serviceTimesWithNumber->count() > -1) {
            foreach ($serviceTimesWithNumber as $item) {
                $messages .= '- ' . $item->show_vehicle->name . ' - waktunya ganti oli atau servis rutin' . PHP_EOL;
            }
        } else {
            $messages .= '' . PHP_EOL;
        }

        $messages .= '' . PHP_EOL;
        $messages .= 'Perlu dilakukan perbaikan' . PHP_EOL;
        $messages .= '' . PHP_EOL;
        $messages .= 'Informasi lebih lanjut silahkan cek pada website yang telah disediakan:' . PHP_EOL;
        $messages .= '...' . PHP_EOL;
        $messages .= '' . PHP_EOL;
        $messages .= 'atau hubungi tim IT PT. Samudera Suri Surabaya';
        $messages .= '' . PHP_EOL;
        $messages .= 'atas perhatiannya kami ucapkan terimakasih';

        //check if the kilometer record needs to be moved to history
        if ($kilometer->service_time === 'yes') {
            // Move the kilometer record to history_kilometers table
            $historyKilometer = new HistoryKilometer();
            $historyKilometer->number = $kilometer->number;
            $historyKilometer->vehicle_id = $kilometer->vehicle_id;
            $historyKilometer->description = $kilometer->description;
            $historyKilometer->tanggal = $kilometer->tanggal;
            $historyKilometer->createdBy = $kilometer->createdBy;
            // $historyKilometer->service_time = $kilometer->service_time;
            // $kilometer->image = $request->image;
            $historyKilometer->image = $kilometer->image;

            $historyKilometer->save();

            // // Delete the kilometer record from the main Kilometer table
            // Kilometer::truncate();

            // Delete the kilometer records from the main Kilometer table
            DB::table('kilometers')->where('service_time', '!=', 'yes')->delete();

            // Update the service_time status for the remaining records
            DB::table('kilometers')->where('service_time', '=', 'yes')->update(['service_time' => 'no']);
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
                    'message' => $messages,
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

        // $this->waktuServis($kilometer);

        return redirect()->route('kilometer.kilometer')->with('berhasil', 'data berhasil diupload')->with('message', $messages);
    }

    public function waktuServis(Request $request)
    {
        // Fetch all kilometers for the specific vehicle ordered by the number in ascending order
        $kilometers = Kilometer::where('vehicle_id', $request->vehicle_id)
            ->orderBy('number', 'asc')
            ->get();

        // Check if the vehicle has any kilometers recorded
        if ($kilometers->isEmpty()) {
            return response()->json(['message' => 'No kilometers found for the selected vehicle'], 200);
        }

        $result = [];
        $lastNumber = null;
        foreach ($kilometers as $kilometer) {
            if ($lastNumber !== null) {
                $difference = $kilometer->number - $lastNumber;
                $kilometer->waktu_servis = $difference >= 10000 ? 'yes' : 'no';
                $result[] = $kilometer;
            }
            $lastNumber = $kilometer->number;
        }

        // Check if the last recorded kilometers is more than 10,000 km from the first recorded kilometers
        if ($lastNumber !== null) {
            $firstKilometer = $kilometers->first();
            $difference = $firstKilometer->number - $lastNumber;
            if ($difference >= 10000) {
                $firstKilometer->waktu_servis = 'yes';
                $result[] = $firstKilometer;
            }
        }

        return response()->json(['kilometers' => $result], 200);
    }

    public function destroy(Kilometer $kilometer)
    {
        // Delete the file from the 'public' disk under 'foto_kondisi' directory
        if ($kilometer->image) {
            Storage::disk('public')->delete('foto_kondisi/' . $kilometer->image);
        }

        $kilometer->delete();

        return redirect()->route('kilometer.kilometer')->with('success', 'data Barang Berhasil Dihapus');
    }
}
