<div>
    <div class="mt-10 mb-10 border-2 p-4 leading-8">
        <x-stamps.title>
            {{$psslog->psslog_id}} - {{$psslog->stampType()}} PERMIT LOG
        </x-stamps.title>

        @include('partials.stamp_user_and_date')
        <br />
        <label>AREA</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[15rem]">
          {{$psslog->area}}
        </span>
        <label>DOOR SIGNS CHECKED</label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[5rem]">
          @if ($psslog->stamp()->data() && $psslog->stamp()->data()->beam_permit_signs)
                {{-- db has values of Y,P,I, and null      --}}
                {{$psslog->stamp()->data()->beam_permit_signs}}
            @else
              &nbsp;&nbsp;
            @endif
        </span>
        <br />
        <br />

        <label>BEAM AUTHORIZATION </label>
        <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[5rem]">
          @if ($psslog->stamp()->data() && $psslog->stamp()->data()->beam_auth)
                {{$psslog->stamp()->data()->beam_auth ? 'Y' : 'N'}}
            @else
                &nbsp;&nbsp;
            @endif
        </span>
        <br />
        <br />
        <label class=comments>COMMENTS:</label>
        <div class="font-bold mt-1">{{strip_tags($psslog->title)}} {{strip_tags($psslog->comments)}}</div>
    </div>

    @include('partials.stamp_attachments')

</div>
