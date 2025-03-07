<div>
<div class="mt-10 mb-10 border-2 p-4 ">
    <x-stamps.title>
        {{$psslog->psslog_id}} - {{$psslog->entry_type}} LOG
    </x-stamps.title>
    @include('partials.stamp_user_and_date')
    <br />
    <label class=hardleft>AREA</label>
    <span class="font-bold inline-block pl-5 border-solid border-black border-b-2 w-[15rem]">
        {{$psslog->area}}
    </span>
    <br />
    <br />
    <label class=comments>COMMENTS:</label>
    <div class="font-bold mt-3">{{$psslog->comments}}</div>
</div>

@include('partials.stamp_attachments')

</div>
