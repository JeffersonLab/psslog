@if ($psslog->hasImageAttachments())
    {{--  It seems that after nearly 20 years, the only attachment mime type found in the database
          is Image/jpg.  This is probably indicative the fact that only the PSSestamp tool is used for
          maming psslog entries and it only attaches screen grabs.  Until that changes we don't need
          to decide where and how to make other non-image attachments accesssible.--}}
    @foreach($psslog->imageAttachments() as $attachment)
        <div>
            <img src="{{route('psslog.attachment',[$psslog->psslog_id, $attachment->attachment_id])}}"
        </div>
    @endforeach
@endif
