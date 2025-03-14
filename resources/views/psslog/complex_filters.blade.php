<div x-show="showAdvancedFilters">
    {{--    {{dd($filters)}}--}}
    <div class="flex flex-col w-full mt-5 bg-gray-100 break-words bg-clip-border border-[1px] border-[solid] rounded">
        <h2>
            <div
                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded focus:ring-4 focus:ring-gray-200  hover:bg-gray-100 gap-3">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                          d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z"/>
                </svg>
                <span>Filters</span>
                <span></span>
            </div>
        </h2>
        <div class="bg-white py-4 px-2">
            <form>
                <div class="flex gap-2">
                    <div class="flex-col w-1/2 align-middle h-12">
                    {{---------------------------------------------------------
                          There's a bug in the bladewind datepicker where it's
                          subtracting a day when we give it a string date.
                          However it seems to function fine when given a carbon date
                        -------------------------------------------------------------}}
                        <x-bladewind::datepicker
                            type="range"
                            :default_date_from="Illuminate\Support\Carbon::parse($filters['start_date'])"
                            :default_date_to="Illuminate\Support\Carbon::parse($filters['end_date'])"
                        />
                    </div>
                    <div class="flex-col w-1/2 h-12">
                        <div class="flex flex-auto h-full align-middle">
                            @foreach (config('settings.options.entry_types') as $type)
                                <div class="flex items-center mt-1 mb-1 align-middle">

                                    <input type="checkbox" name="types[]" value="{{$type}}"
                                           {{in_array($type, $filters['types']) ? 'checked' : ''}}
                                           class="w-4 h-4 ml-1  text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                                    <label class="ms-2 text-sm">{{$type}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <div class="flex-col w-1/3 align-middle h-12">
                        <x-bladewind::select
                            :selected_value="$filters['entry_maker']"
                            searchable="true"
                            name="entry_maker"
                            placeholder="Entry Maker"
                            :data="$entryMakerOptions"/>
                    </div>
                    <div class="flex-col w-2/3 align-middle h-12">
                        <x-bladewind::input label="Text Contains"/>
                    </div>
                </div>
                <div class="my-4 flex">
                    <div class="w-3/4"></div>
                    <button type="button" @click="$event.target.form.submit();"
                            class="w-1/4 object-right text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300
            font-med rounded-lg text-xs px-3 py-2 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700
            focus:outline-none dark:focus:ring-blue-800">Apply
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
