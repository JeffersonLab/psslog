<form>
    <div
        x-data
        x-init="
    flatpickr($refs.dateInput, {
      altInput: true,
      altFormat: 'F j, Y',
      dateFormat: 'Y-m-d'
    })
  "
    >
        <input x-ref="dateInput" type="text" placeholder="YYYY-MM-DD" class="w-full" />
    </div>

@foreach (config('settings.options.entry_types') as $type)
    <div class="flex items-center mb-1">
        <input type="checkbox" value="{{$type}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
        <label class="ms-2 text-sm">{{$type}}</label>
    </div>
@endforeach
</form>
