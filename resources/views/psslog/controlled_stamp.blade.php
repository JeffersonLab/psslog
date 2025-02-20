<div class="m-10 border-2 w-3/4 p-4">
    <div class=title><h1>CONTROLLED ACCESS LOG</h1></div>
    <label>SSO</label>
    <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[15rem]">
        {{$psslog->entry_maker}}
    </span>
    <label>DATE</label>
    <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[10rem]">
        {{$psslog->entry_timestamp->format('m/d/Y')}}
    </span>
    <label>TIME</label>
    <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[5rem]">
        {{$psslog->entry_timestamp->format('H:i')}}
    </span>
    <br />
    <label class=hardleft>AREA ACCESSED</label>
    <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[15rem]">
        {{$psslog->area}}
    </span>
    <br />
    @if ($psslog->area == 'LERF')
    <label class=hardleft>LASER BYPASS MODE</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[5rem]">
            {{$psslog->stamp()->data()->laser_bypass_mode ? 'Y' : 'N'}}
        </span>
    <br />
    @endif
    <label class=hardleft>REASON FOR ACCESS</label>
    <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[15rem]">
        {{$psslog->stamp()->data()->reason}}
    </span>
    <br />
    <label class=hardleft>SURVEY_REQUIRED</label>
    <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[5rem]">
        {{\App\Models\Stamp::expandFPN($psslog->stamp()->data()->survey_required)}}
    </span>
    <label>SSO REVIEWED SURVEY LOG</label>
    <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[5rem]">
        {{$psslog->stamp()->data()->survey_reviewed ? 'Y' : 'N'}}
    </span>
    <br />
    <label class=hardleft>ARM</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[15rem]">
            {{$psslog->stamp()->data()->arm}}
        </span>
    <label>FULL SURVEY COMPLETED @:</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[5rem]">

        </span>
    <br />
    <br />
    <label class=comments>COMMENTS:</label>
    <div class=commentsDiv>{{$psslog->comments}}</div>
    </div>
</div>

<div class="m-10 border-2 w-3/4 p-4">
    @include('psslog.accesses_table',['accesses' => $psslog->stamp()->data()->accesses])

</div>
