<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Attachment;
use App\Models\Psslog;
use App\Models\PsslogCollection;
use Illuminate\Http\Request;

class PsslogController extends Controller
{

    /**
     * An index page listing recent or requested psslog entries as well
     * as any open accesses underway.
     */
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

    /**
     * A single psslog entry
     */
    public function item(Psslog $psslog, Request $request){
        return view('psslog.item')->with('psslog', $psslog);
    }

    /**
     * Return a psslog entry attachment as raw data
     */
    public function attachment(Psslog $psslog, Attachment $attachment, Request $request){
        header("Content-disposition: filename=".$attachment->filename_orig);
        header("Content-type: ".$attachment->mime_type);
        header("Content-length: ".$attachment->data_size);
        print($attachment->data);

    }


}
