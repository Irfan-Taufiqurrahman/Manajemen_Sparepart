<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Part;
use App\Models\Quality;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MaintenanceController extends Controller
{
    public function tes()
    {
        return view('tes.tes');
    }

    public function index()
    {
        $maintenance = Maintenance::all();
        $parts = Part::all();
        $vehicles = Vehicle::all();
        $qualities =  Quality::all();
        return view('maintenance', compact('maintenance', 'parts', 'vehicles', 'qualities'));
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

        return redirect()->route('maintenance.index')->with('success', 'Berhasil upload kondisi barang');
    }

    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();

        return redirect()->route('maintenance.index')->with('success', 'Kondisi Barang Berhasil Dihapus');
    }
}
