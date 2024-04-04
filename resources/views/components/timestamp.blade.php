@props(['timestamp'])

{{ \Illuminate\Support\Carbon::parse($timestamp)->timezone(auth()->user()->timezone)->format('m-d-Y g:i A') }}
