<div>
<div class="mt-10 mb-10 border-2 p-4 ">
    <div class=title><h1 class="text-red-600 font-bold text-lg text-center mb-5">INFO LOG</h1></div>
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
