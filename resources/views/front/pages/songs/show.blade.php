@extends('front.layouts.app')

@section('content')
    <script>
    var song = {!! json_encode($song->toArray(), JSON_UNESCAPED_UNICODE) !!};
    var baseUrl = '{{ config('app.url') }}'
    </script>
    <div id="app">
        <song-single></song-single>
    </div>
@endsection

@push('preload')
    @foreach($song->tracks as $track)
        <link rel="preload" href="{{ Storage::url($track->image) }}" as="image">
    @endforeach
@endpush
