<?php

namespace App\Http\Controllers;

use App\Models\HistoryKilometer;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class serviceController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $maintenance = Maintenance::all();
            $barangRusak = [];
            foreach ($maintenance as $item) {
                if ($item->quality_id == 3) { // Assuming quality_id 3 represents "bad" quality
                    $barangRusak[] = $item;
                }
            }
            // $totalParts = Part::count();
            $serviceTimes = HistoryKilometer::all();
            return view('maintenance.serviceTime.index', compact('serviceTimes', 'barangRusak'));
        }
    }

    public function destroy(HistoryKilometer $serviceTimes)
    {
        // Delete the file from the 'public' disk under 'foto_kondisi' directory
        // if ($serviceTimes->image) {
        //     Storage::disk('public')->delete('foto_kondisi/' . $serviceTimes->image);
        // }
        // dd($serviceTimes);
        $serviceTimes->delete();

        return redirect()->route('service.index')->with('success', 'data Barang Berhasil Dihapus');
    }
}
