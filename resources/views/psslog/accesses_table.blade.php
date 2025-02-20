

<div id="open-accesses" class="shadow-md sm:rounded-lg mb-4">
    <h2> Open Accesses </h2>
    <table class="min-w-full table-auto text-xs text-left  text-gray-700 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-0 py-1">
                Full Name
            </th>
            <th scope="col" class="px-0 py-1">
                Area
            </th>
            <th scope="col" class="px-0 py-1">
                Date
            </th>
            <th scope="col" class="px-0 py-1">
                Time In
            </th>
            <th scope="col" class="px-0 py-1">
                SSO In
            </th>
            <th scope="col" class="px-0 py-1">
                Key #
            </th>
            <th scope="col" class="px-0 py-1">
                SSO Out
            </th>
            <th scope="col" class="px-0 py-1">
                Comments
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($accesses as $access)
        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
            <td>{{$access->full_name}}</td>
            <td>{{$access->psslog->area}}</td>
            <td>{{$access->time_in->format('m-d-y')}}</td>
            <td>{{$access->time_in->format('H:i')}}</td>
            <td>{{$access->sso_in}}</td>
            <td>{{$access->key_num}}</td>
            <td>{{$access->sso_out}}</td>
            <td>{{$access->psslog->comments}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
