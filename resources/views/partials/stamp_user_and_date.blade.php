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
