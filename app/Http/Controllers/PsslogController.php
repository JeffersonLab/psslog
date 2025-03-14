<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Attachment;
use App\Models\Psslog;
use App\Models\PsslogCollection;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class PsslogController extends Controller {

    /**
     * An index page listing recent or requested psslog entries as well
     * as any open accesses that are underway, and a sidebar with filters
     * and links.
     */
    public function index(Request $request): View {
        $query = $this->indexQuery($request);

        /* We will store a list of psslog_id values from the entire query results
           in the session to assist the previous/next paginator shown when viewing
           an entry.  This will allow the paginator to move through the entire
           result set and not just the current page.
         */
        session()->put('psslog_ids', $query->pluck('psslog_id')->toArray());
        // For the user we will paginate data to a limited number of items per page
        $paginatedData = $query->paginate(config('settings.paginate'));

        return view('psslog.index')
            ->with('filters', $request->session()->get('filters'))
            ->with('entries', $this->getEntriesCollection($paginatedData, $request))
            ->with('accesses', $this->getOpenAccesses($request))
            ->with('entryMakerOptions', $this->entryMakerOptions())
            ->with('paginatorLinks', $paginatedData->withQueryString()->links('vendor.pagination.tailwind'));
    }

    /**
     * Retrieves just the table of psslog entries shown on the index page.
     * This can be used to refresh just the entries table without a full page
     * reload.
     */
    public function list(Request $request): View {
        $paginatedData = $this->indexQuery($request)
            ->paginate(config('settings.paginate'));

        return view('psslog.entries')
            ->with('entries', $this->getEntriesCollection($paginatedData, $request));
    }


    /**
     * Obtain the base query for building the index list of psslog entries.
     * The filters stored in the session by the DisplaySettings middleware
     * are applied to the query.
     */
    protected function indexQuery(Request $request): Builder {
        $session = $request->session();
        $endDate = Carbon::createFromFormat('Y-m-d', $session->get('filters.end_date'));
        $endDate = $endDate->endOfDay();  // We want up to 00:00 of tomorrow

        $startDate = Carbon::createFromFormat('Y-m-d', $session->get('filters.start_date'));
        $startDate = $startDate->endOfDay();  // We want up to 00:00 of tomorrow


        $query = Psslog::query();

        $query->whereIn('entry_type', $session->get('filters.types')); // STAMP, AUTO, etc.
        $query->where('entry_timestamp', '<', $endDate);
        $query->where('entry_timestamp', '>=', $startDate);

        if ($session->has('filters.entry_maker')){
            $query->where('entry_maker', $session->get('filters.entry_maker'));
        }

        $query->orderBy('entry_timestamp', 'desc');

        return $query;
    }

    /**
     * Convert query data into a PsslogCollection which supports grouping of
     * results
     */
    protected function getEntriesCollection(Paginator $data, Request $request): PsslogCollection {
        $collection = new PsslogCollection($data->all());
        if ((config('settings.display.grouping') && strtoupper(config('settings.display.grouping')) != 'NONE')) {
            $entries = $collection->groupBy(config('settings.display.grouping'));
        }
        else {
            $entries = $collection;
        }

        return $entries;
    }

    protected function entryMakerOptions(): array {
        return User::all()->sortBy('lastname')->map(function(User $user) {
           return ['label' => $user->lastFirst(), 'value' => $user->getKey()];
        })->toArray();
    }

    /**
     * Fetch the collection of ongoing open accesses.
     */
    protected function getOpenAccesses(Request $request): Collection {
        return Access::where('time_out', NULL)
            ->orderBy('time_in', 'desc')
            ->get();
    }

    /**
     * Get the psslog before the given psslog using last index query results if
     * possible otherwise chronologically.
     */
    protected function previousEntry(Psslog $psslog, Request $request): ?Psslog {
        $session = $request->session();
        if ($session->has('psslog_ids')) {
            return $this->previousEntryFromSessionIds($psslog, $session->get('psslog_ids'));
        }
        return $this->previousEntryByDate($psslog);
    }

    /**
     * Get the psslog before the given psslog chronologically
     */
    protected function previousEntryByDate(Psslog $psslog): ?Psslog {
        return Psslog::where('entry_timestamp', '<=', $psslog->entry_timestamp)
            ->where('psslog_id', '<', $psslog->psslog_id)
            ->orderBy('entry_timestamp', 'desc')
            ->take(1)
            ->first();
    }

    /**
     * Get the url of the psslog before the given psslog
     */
    protected function previousUrl(Psslog $psslog, Request $request): string {
        $previousEntry = $this->previousEntry($psslog, $request);
        if ($previousEntry) {
            return route('psslog.item', [$previousEntry->psslog_id]);
        }
        return '';
    }

    /**
     * Get the psslog entry before the provided entry using the array of
     * ids provided.
     */
    protected function previousEntryFromSessionIds(Psslog $psslog, array $ids): ?Psslog {
        $i = array_search($psslog->psslog_id, $ids);
        $previousIndex = $i + 1;   // add because next means move down/backwards through the chronological list
        if (array_key_exists($previousIndex, $ids)) {
            return Psslog::where('psslog_id', $ids[$previousIndex])->first();
        }
        return NULL;
    }

    /**
     * Get the psslog after the given psslog using last index query results if
     * possible otherwise chronologically.
     */
    protected function nextEntry(Psslog $psslog, Request $request): ?Psslog {
        $session = $request->session();
        if ($session->has('psslog_ids')) {
            return $this->nextEntryFromSessionIds($psslog, $session->get('psslog_ids'));
        }
        return $this->nextEntryByDate($psslog);
    }

    /**
     * Get the psslog entry after the provided entry using the array of
     * ids provided.
     */
    protected function nextEntryFromSessionIds(Psslog $psslog, array $ids): ?Psslog {
        $i = array_search($psslog->psslog_id, $ids);
        $nextIndex = $i - 1;   // subtract because next means move up/forwards through the chronological list
        if (array_key_exists($nextIndex, $ids)) {
            return Psslog::where('psslog_id', $ids[$nextIndex])->first();
        }
        return NULL;
    }

    /**
     * Get the psslog after the given psslog chronologically
     */
    protected function nextEntryByDate(Psslog $psslog): ?Psslog {
        return Psslog::where('entry_timestamp', '>=', $psslog->entry_timestamp)
            ->where('psslog_id', '>', $psslog->psslog_id)
            ->orderBy('entry_timestamp', 'asc')
            ->take(1)
            ->first();
    }

    /**
     * Get the url of the psslog before the given psslog
     */
    protected function nextUrl(Psslog $psslog, Request $request): string {
        $nextEntry = $this->nextEntry($psslog, $request);
        if ($nextEntry) {
            return route('psslog.item', [$nextEntry->psslog_id]);
        }
        return '';
    }

    /**
     * Get a table of currently open accesses
     */
    public function openAccesses(): View {
        $accesses = Access::where('time_out', NULL)
            ->orderBy('time_in', 'desc')
            ->get();

        return view('psslog.accesses_table')
            ->with('accesses', $accesses)
            ->with('title', 'Open Accesses')
            ->with('mode', 'brief');
    }

    /**
     * Display a single psslog entry
     */
    public function item(Psslog $psslog, Request $request): View {
        return view('psslog.item')
            ->with('psslog', $psslog)
            ->with('nextUrl', $this->nextUrl($psslog, $request))
            ->with('previousUrl', $this->previousUrl($psslog, $request));
    }

    /**
     * Print a psslog entry attachment.
     */
    public function attachment(Psslog $psslog, Attachment $attachment, Request $request): void {
        header('Content-disposition: filename=' . $attachment->filename_orig);
        header('Content-type: ' . $attachment->mime_type);
        header('Content-length: ' . $attachment->data_size);
        echo $attachment->data;
    }

}
