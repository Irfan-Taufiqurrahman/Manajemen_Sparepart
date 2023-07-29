<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\SQLite;

class CustomFilterController extends Controller
{
    public function index()
    {
        return view('tes.tes');
    }
}
