<div>
    <div class="mt-10 mb-10 border-2 p-4 leading-8">

        <x-stamps.title>
            {{$psslog->psslog_id}} - {{$psslog->stampType()}} LOG
        </x-stamps.title>

        @include('partials.stamp_user_and_date')
        <br />
        <label>SURVEY REQUIRED</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[15rem]">
          {{\App\Models\Stamp::formatFPN($psslog->stamp()->data()->survey_required)}}
        </span>
        <label>AREA SWEPT</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[15rem]">
          {{$psslog->area}}
        </span>
        <br />
        <label>RADCON CHECKLIST PERFORMED</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[5rem]">
                {{$psslog->stamp()->data()->radcon_checklist ? 'Y' : 'N'}}
        </span>
        <br />
        <label>ANNOUNCEMENTS AT 15 MIN </label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[5rem]">
            @if ($psslog->stamp()->data()->announce15)
                {{ $psslog->stamp()->data()->announce15->format('H:i') }}
            @else
                &nbsp;&nbsp;
            @endif
        </span>
        <label>5 MIN </label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[5rem]">
            @if ($psslog->stamp()->data()->announce05)
                {{ $psslog->stamp()->data()->announce05->format('H:i') }}
            @else
                &nbsp;&nbsp;
            @endif
        </span>
        <br />
        <label>SWEEP TEAM</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[25rem]">
          @if ($psslog->stamp()->data()->sweepers)
                {{$psslog->stamp()->data()->sweepers}}
            @else
                &nbsp;&nbsp;
            @endif
        </span>
        <label>TLD/ODH</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[5rem]">
                {{$psslog->stamp()->data()->sweeper_tld_odh ? 'Y' : 'N'}}
        </span>
        <br />
        <label>SWEEP COMPLETED AT </label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[5rem]">
            @if ($psslog->stamp()->data()->sweep_completed)
                {{ $psslog->stamp()->data()->sweep_completed->format('H:i') }}
            @else
                &nbsp;&nbsp;
            @endif
        </span>
        <br />
        <br />
        <label class=comments>COMMENTS:</label>
        <div class="font-bold mt-1">{{strip_tags($psslog->comments)}}</div>
    </div>

    @include('partials.stamp_attachments')

</div>
