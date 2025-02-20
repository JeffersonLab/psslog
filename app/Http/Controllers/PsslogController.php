<?php

namespace App\Http\Controllers;

use App\Models\Psslog;
use Illuminate\Http\Request;

class PsslogController extends Controller
{
    public function index(){
        $entries = Psslog::where('entry_type','STAMP')->latest('entry_timestamp')->take(20)->get();
        return view('psslog.index')->with('entries', $entries);
    }
}
