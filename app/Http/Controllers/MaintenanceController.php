<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Part;
use App\Models\Quality;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenance = Maintenance::all();
        return view('maintenance', compact('maintenance'));
    }

    public function create()
    {
        $parts = Part::all();
        $vehicles = Vehicle::all();
        $qualities =  Quality::all();
        return view('maintenance.create', compact('parts', 'vehicles', 'qualities'));
    }

    public function store(Request $request)
    {
        $maintenance = new Maintenance();
        $maintenance->part_id = $request->part_id;
        $maintenance->vihicle_id =  $request->vehicle_id;
        $maintenance->quality_id = $request->quality_id;
        $maintenance->description = $request->description;
        $maintenance->createdBy = $request->createdBy;
        // $maintenance->file_image = $request->file_image;
        $gambar = array();
        //save foto barang
        if ($request->hasFile('file_image')) {
            $image =  $request->file('file_image')->move('foto_kondisi/', $request->file('fotoDokumen')->getClientOriginalName());
            $maintenance->file_image = $request->file('file_image')->getClientOriginalName();
            $gambar[] =  $maintenance->file_image;
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
