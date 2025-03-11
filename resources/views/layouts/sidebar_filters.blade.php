<form id="filter-block" x-data method="get" action="{{route('psslog.index')}}">
    <input x-ref="dateInput" name="date" type="hidden" class="invisible h-0 p-0 m-0" placeholder="YYYY-MM-DD"
           @change="$event.target.form.submit();" value=""/>
    <div class="flex items-center "
         x-init="flatpickr($refs.dateInput, {
                      dateFormat: 'Y-m-d',
                      inline: true,
                      defaultDate: '{{$filters["date"]}}'
         })"
    >

    </div>
    @foreach (config('settings.options.entry_types') as $type)
        <div class="flex items-center mb-1">
            <input type="checkbox" name="types[]" value="{{$type}}"
                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
            <label class="ms-2 text-sm">{{$type}}</label>
        </div>
    @endforeach

    <input type="submit" value="submit" @click.debounce.2000ms="$event.target.form.submit();"/>
</form>
