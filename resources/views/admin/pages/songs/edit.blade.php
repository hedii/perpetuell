@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 mb-3">
            <h3>Song #{{ $song->id }}</h3>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="order-lg-last col-lg-4 col-xl-3">
            <div class="card mb-3">
                <div class="card-header">Actions</div>
                <div class="card-body">
                    <div>
                        <a class="btn btn-secondary"
                           href="{{ route('admin.songs.index') }}">
                            Back
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="order-lg-first col-lg-8 col-xl-9">
            <div class="card mb-3">
                <div class="card-header">Song</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="control-label">Name</label>
                                <input type="text"
                                       id="name"
                                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                       name="name"
                                       value="{{ $song->name }}"
                                       required>
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ $song->image_url }}"
                                 alt="song image"
                                 class="img-fluid mb-3">
                        </div>

                        <div class="col-md-6">
                            <video controls style="width: 100%;" class="mb-3">
                                <source src="{{ $song->video_url }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @for($i = 1; $i <=8; $i++)
                    <div class="col-lg-6">
                        <div class="card mb-3">
                            <div class="card-header">Track {{ $i }}</div>
                            <div class="card-body">
                                <div style="background: #000; width: 100%" class="mb-3 p-2">
                                    <img src="{{ $song->tracks[$i - 1]->image_url }}"
                                         alt="track {{ $i }} image"
                                         class="img-fluid">
                                </div>

                                <audio controls style="width: 100%" class="mb-3">
                                    <source src="{{ $song->tracks[$i - 1]->audio_url }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection
