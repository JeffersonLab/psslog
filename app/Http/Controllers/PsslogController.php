<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Psslog;
use App\Models\PsslogCollection;
use Illuminate\Http\Request;

class PsslogController extends Controller
{
    public function index(Request $request){
        $data = Psslog::orderBy('entry_timestamp','desc')->paginate(50);
        $collection = new PsslogCollection($data->all());
        if ($request->has('groupBy') && strtoupper($request->get('groupBy')) != 'NONE') {
            $entries = $collection->groupBy($request->get('groupBy'));
        }else{
            $entries = $collection;
        }

        $accesses = Access::where('time_out',null)->orderBy('time_in','desc')->get();

        return view('psslog.index')
            ->with('entries', $entries)
            ->with('accesses', $accesses)
            ->with('paginatorLinks', $data->withQueryString()->onEachSide(3)->links());
    }

    public function item(Psslog $psslog, Request $request){
        return view('psslog.item')->with('psslog', $psslog);
    }
}
