<div>
    <div class="mt-10 mb-10 border-2 p-4 ">
        <x-stamps.title>
            {{$psslog->psslog_id}} - CONTROLLED ACCESS LOG
        </x-stamps.title>
        @include('partials.stamp_user_and_date')
        <br/>
        <label class=hardleft>AREA TO RESTRICTED ACCESS</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[15rem]">
            {{$psslog->area}}
        </span>
        <br/>
        <label class=hardleft>REASON FOR RESTRICTED ACCESS</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[15rem]">
            {{$psslog->stamp()->data()->reason}}
        </span>
        <br />
        <label class=hardleft>SURVEY_REQUIRED</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[5rem]">
            {{\App\Models\Stamp::formatFPN($psslog->stamp()->data()->survey_required)}}
        </span>
        <br />
        <label>SURVEY COMPLETED @:</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[5rem]">
            {{$psslog->stamp()->data()->survey_completed->format('H:i')}}
        </span>
        <br/>
        <br/>
        <label class=comments>COMMENTS:</label>
        <div class="font-bold mt-2 whitespace-pre-line">
            {{$psslog->comments}}
        </div>
    </div>
</div>
