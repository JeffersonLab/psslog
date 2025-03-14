<form id="filter-block" x-data method="get" action="{{route('psslog.index')}}" class="w-full">
    <input x-ref="dateInput" name="end_date" type="hidden" class="invisible h-0 p-0 m-0" placeholder="YYYY-MM-DD"
           @change="$event.target.form.submit();" value=""/>
    <div class="flex items-center "
         x-init="flatpickr($refs.dateInput, {
                      dateFormat: 'Y-m-d',
                      inline: true,
                      defaultDate: '{{$filters["end_date"]}}'
         })"
    >

    </div>
    <div class="flex flex-auto">
        @foreach (config('settings.options.entry_types') as $type)
            <div class="flex items-center mt-1 mb-1">

                <input type="checkbox" name="types[]" value="{{$type}}"
                       {{in_array($type, $filters['types']) ? 'checked' : ''}}
                       class="w-4 h-4 ml-1  text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                <label class="ms-2 text-sm">{{$type}}</label>
            </div>
        @endforeach
    </div>

    <div class="grid content-end">
        <button type="button" @click.debounce.1000ms="$event.target.form.submit();"
                class=" object-right text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300
            font-med rounded-lg text-xs px-3 py-2 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700
            focus:outline-none dark:focus:ring-blue-800">Apply</button>
    </div>


</form>
