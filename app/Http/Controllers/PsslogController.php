<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Psslog;
use App\Models\PsslogCollection;
use Illuminate\Http\Request;

class PsslogController extends Controller
{
    public function index(Request $request){
        $data = Psslog::latest('entry_timestamp')->take(50)->get();
        $collection = new PsslogCollection($data);
        if ($request->has('groupBy') && strtoupper($request->get('groupBy')) != 'NONE') {
            $entries = $collection->groupBy($request->get('groupBy'));
        }else{
            $entries = $collection;
        }

        $accesses = Access::where('time_out',null)->orderBy('time_in','desc')->get();

        return view('psslog.index')
            ->with('entries', $entries)
            ->with('accesses', $accesses);
    }
}
