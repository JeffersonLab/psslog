<div class="psslog-entries" class="shadow-md sm:rounded-lg">
    <table class="min-w-full table-auto text-xs text-left  text-gray-900 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-0 py-1">
                PSSLog ID
            </th>
            @if($showDate)
            <th scope="col" class="px-0 py-1">
                Date
            </th>
            @endif
            <th scope="col" class="px-0 py-1">
                Time
            </th>
            <th scope="col" class="px-0 py-1">
                Area
            </th>
            <th scope="col" class="px-0 py-1">
                Type
            </th>
            <th scope="col" class="px-0 py-1">
                User
            </th>
            <th scope="col" class="px-0 py-1">
                Title
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($entries as $entry)
        <tr class="odd:bg-white  even:bg-yellow-100 border-b border-gray-200">
            <td><a class="text-blue-600 hover:underline" href="{{route('psslog.item',[$entry->psslog_id])}}">{{$entry->psslog_id}}</a></td>
            @if($showDate)
            <td>{{$entry->entry_timestamp->format('m-d-Y')}}</td>
            @endif
            <td>{{$entry->entry_timestamp->format('H:i')}}</td>
            <td>{{$entry->area}}</td>
            <td>{{$entry->entry_type}}</td>
            <td>{{$entry->entryMaker ? $entry->entryMaker->fLastname() : '_'}}</td>
            <td><a class="text-blue-700 hover:underline" href="{{route('psslog.item',[$entry->psslog_id])}}">{{$entry->title}}</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

