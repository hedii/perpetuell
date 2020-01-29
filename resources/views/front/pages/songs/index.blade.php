@extends('front.layouts.app')

@section('content')
    <div class="container">
        @foreach($songs as $song)
            <div class="row justify-content-center">
                <div class="col-md-6 mb-3">
                    <a href="{{ route('front.songs.show', $song) }}">
                        <img src="{{ Storage::url($song->image) }}"
                             alt="{{ $song->name }}"
                             class="img-fluid">
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
