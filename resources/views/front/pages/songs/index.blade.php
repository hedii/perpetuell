@extends('front.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($songs as $song)
                <div class="col-md-6 col-md-offset-3">
                    <a href="{{ route('front.songs.show', $song) }}">
                        <img src="{{ $song->image }}" alt="{{ $song->name }}" style="width: 100%">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
