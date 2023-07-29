<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // $totalParts = Part::count();
            $parts = Part::all();
            return view('part.parts', compact('parts'));
        }
    }

    public function create()
    {
        return view('parts.create');
    }

    public function store(Request $request)
    {
        $part = new Part();
        $part->name = $request->name;

        $part->save();
        return redirect()->route('part.parts')->with('success', 'Berhasil upload Parts');
    }
    public function destroy(Part $part)
    {
        $part->delete();

        return redirect()->route('part.parts')->with('success', 'Kondisi Barang Berhasil Dihapus');
    }
}
