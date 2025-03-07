<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Attachment;
use App\Models\Psslog;
use App\Models\PsslogCollection;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PsslogController extends Controller
{

    /**
     * An index page listing recent or requested psslog entries as well
     * as any open accesses that are underway.
     */
    public function index(Request $request){

        $paginatedData = $this->getEntries($request)->paginate(50);

        return view('psslog.index')
            ->with('entries', $this->getEntriesCollection($paginatedData, $request))
            ->with('accesses', $this->getAccesses($request))
            ->with('paginatorLinks', $paginatedData->withQueryString()->onEachSide(3)->links());
    }

    /**
     * Show a table of psslog entries
     */
    public function list(Request $request){
        $paginatedData = $this->getEntries($request)->paginate(50);
        return view('psslog.entries')
            ->with('entries', $this->getEntriesCollection($paginatedData, $request));
    }

    protected function getEntries(Request $request) {
        return Psslog::orderBy('entry_timestamp','desc');
    }

    protected function getEntriesCollection(Paginator $data, Request $request): Collection {

        $collection = new PsslogCollection($data->all());
        if ($request->has('groupBy') && strtoupper($request->get('groupBy')) != 'NONE') {
            $entries = $collection->groupBy($request->get('groupBy'));
        }else{
            $entries = $collection;
        }
        return $entries;
    }

    protected function getAccesses(Request $request) : Collection {
        return Access::where('time_out',null)->orderBy('time_in','desc')->get();
    }

    /**
     * Show the previous entry before the given psslog
     */
    public function previous(Psslog $psslog, Request $request){
        $previous = $this->previousEntry($psslog, $request);
        if ($previous){
            return redirect()->route('psslog.item',[$previous->psslog_id]);
        }
        // No prior entries so go to index
        return redirect()->route('psslog.index');
    }

    /**
     * Get the psslog before the given psslog
     */
    protected function previousEntry(Psslog $psslog, Request $request) {
        return Psslog::where('entry_timestamp','<=',$psslog->entry_timestamp)
            ->where('psslog_id','<', $psslog->psslog_id)
            ->orderBy('entry_timestamp','desc')
            ->take(1)
            ->first();
    }

    /**
     * Get the url of the psslog before the given psslog
     */
    protected function previousUrl(Psslog $psslog, Request $request) {
        $previousEntry = $this->previousEntry($psslog, $request);
        if ($previousEntry){
            return route('psslog.item',[$previousEntry->psslog_id]);
        }
    }

    protected function nextEntry(Psslog $psslog, Request $request) {
        return Psslog::where('entry_timestamp','>=',$psslog->entry_timestamp)
            ->where('psslog_id','>', $psslog->psslog_id)
            ->orderBy('entry_timestamp','asc')
            ->take(1)
            ->first();
    }

    protected function nextUrl(Psslog $psslog, Request $request) {
        $nextEntry = $this->nextEntry($psslog, $request);
        if ($nextEntry){
            return route('psslog.item',[$nextEntry->psslog_id]);
        }
    }

    /**
     * Show the next entry after the given psslog
     */
    public function next(Psslog $psslog, Request $request){
        $next = $this->nextEntry($psslog, $request);
        if ($next) {
            return redirect()->route('psslog.item',[$next->psslog_id]);
        }
        // No more next entries so go to index
        return redirect()->route('psslog.index');

    }


    /**
     * Get a table of currently open accesses
     */
    public function openAccesses(){
        $accesses = Access::where('time_out',null)->orderBy('time_in','desc')->get();
        return view('psslog.accesses_table')
            ->with('accesses', $accesses)
            ->with('title', 'Open Accesses')
            ->with('mode', 'brief');
    }

    /**
     * Display a single psslog entry
     */
    public function item(Psslog $psslog, Request $request){
        return view('psslog.item')
            ->with('psslog', $psslog)
            ->with('nextUrl', $this->nextUrl($psslog, $request))
            ->with('previousUrl', $this->previousUrl($psslog, $request));
    }


    /**
     * Print a psslog entry attachment.
     *
     */
    public function attachment(Psslog $psslog, Attachment $attachment, Request $request){
        header("Content-disposition: filename=".$attachment->filename_orig);
        header("Content-type: ".$attachment->mime_type);
        header("Content-length: ".$attachment->data_size);
        print($attachment->data);
    }


}

