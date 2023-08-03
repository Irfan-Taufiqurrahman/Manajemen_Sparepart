<?php

namespace App\Http\Controllers;

use App\Models\HistoryKilometer;
use App\Models\Maintenance;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function update(Request $request, HistoryKilometer $serviceTimes)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'description' => 'required',
            'file_service_evidence' => 'required|image|mimes:jpeg,png,jpg,gif'
            // Add more validation rules for other fields as needed
        ]);

        // Update the record
        // $serviceTimes->update($validatedData);
        $serviceTimes->description = $request->input('description');
        // $serviceTimes->file_service_evidence = $request->input('file_service_evidence');
        if ($request->hasFile('file_service_evidence')) {
            $file = $request->file('file_service_evidence');
            $filename = time() . '_needService_' . $file->getClientOriginalName();
            $file->storeAs('foto_kondisi', $filename, 'public'); // Save the file to the 'public' disk under 'foto_kondisi' directory
            $serviceTimes->file_service_evidence = $filename;
        }

        // Set the 'status_service' field to "yes"
        $serviceTimes->status_service = 'yes';

        $serviceTimes->save();
        // dd($serviceTimes);

        return redirect()->route('service.index')->with('success', 'Data updated successfully.');
    }


    public function viewPdf(Request $request)
    {
        // $data = Maintenance::all();
        $from = $request->input('from');
        $to = $request->input('to');

        $data = HistoryKilometer::query();

        if ($from && $to) {
            $data->whereBetween('tanggal', [$from, $to]);
        }

        $data = $data->get();

        $pdf = Pdf::loadView('pdf.exportpdf', compact('data', 'from', 'to'));
        return $pdf->stream();
        // return $pdf->inline
    }

    public function destroy(HistoryKilometer $serviceTimes)
    {
        // Delete the file from the 'public' disk under 'foto_kondisi' directory
        if ($serviceTimes->image) {
            Storage::disk('public')->delete('foto_kondisi/' . $serviceTimes->image);
        }
        // dd($serviceTimes);
        $serviceTimes->delete();

        return redirect()->route('service.index')->with('success', 'data Barang Berhasil Dihapus');
    }
}
