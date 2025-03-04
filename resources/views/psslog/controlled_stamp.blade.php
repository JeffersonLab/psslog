<div>
    <div class="mt-10 mb-10 border-2 p-4 ">
        <div class=title><h1 class="text-red-600 font-bold text-lg text-center mb-5">CONTROLLED ACCESS LOG</h1></div>
        <label>SSO</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[15rem]">
        {{$psslog->entryMaker->flastName()}}
    </span>
        <label>DATE</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[10rem]">
        {{$psslog->entry_timestamp->format('m/d/Y')}}
    </span>
        <label>TIME</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[5rem]">
        {{$psslog->entry_timestamp->format('H:i')}}
    </span>
        <br/>
        <label class=hardleft>AREA ACCESSED</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[15rem]">
        {{$psslog->area}}
    </span>
        @if ($psslog->area == 'LERF')
            <label class=hardleft>LASER BYPASS MODE</label>
            <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[5rem]">
            {{$psslog->stamp()->data()->laser_bypass_mode ? 'Y' : 'N'}}
        </span>
        @endif
        <br/>
        <label class=hardleft>REASON FOR ACCESS</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[15rem]">
        {{$psslog->stamp()->data()->reason}}
    </span>
        <br/>
        <label class=hardleft>SURVEY_REQUIRED</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[5rem]">
        {{\App\Models\Stamp::formatFPN($psslog->stamp()->data()->survey_required)}}
    </span>
        <label>SSO REVIEWED SURVEY LOG</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[5rem]">
        {{$psslog->stamp()->data()->survey_reviewed ? 'Y' : 'N'}}
    </span>
        <br/>
        <label class=hardleft>ARM</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[15rem]">
            {{$psslog->stamp()->data()->arm}}
        </span>
        <label>FULL SURVEY COMPLETED @:</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[5rem]">

        </span>
        <br/>
        <br/>
        <label class=comments>COMMENTS:</label>
        <div class="font-bold mt-2 whitespace-pre-line">
                {{$psslog->comments}}
        </div>
    </div>

    @if ($psslog->stamp()->data()->accesses->isNotEmpty())
    <div class="border-2 p-4">
        @include('psslog.accesses_table',['title' => 'Related Accesses', 'accesses' => $psslog->stamp()->data()->accesses, 'mode' => 'expanded'])
    </div>
    @endif

    @include('partials.stamp_attachments')

</div>
