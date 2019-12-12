@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 mb-3">
            <h3>Edit Song #{{ $song->id }}</h3>
            <hr>
        </div>
    </div>

    <form action="{{ route('admin.songs.update', $song) }}"
          method="post"
          accept-charset="utf-8"
          enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="row">
            <div class="order-lg-last col-lg-4 col-xl-3">
                <div class="card mb-3">
                    <div class="card-header">Actions</div>
                    <div class="card-body">
                        <div class="form-group form-check">
                            <input type="checkbox"
                                   id="is_published"
                                   class="form-check-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                   name="is_published"
                                   value="true" {{ $song->is_published ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_published">Published</label>
                            <div class="invalid-feedback">{{ $errors->first('is_published') }}</div>
                        </div>
                        <hr>
                        <div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a class="btn btn-secondary"
                               href="{{ route('admin.songs.index') }}">
                                Cancel
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
                                <div class="form-group">
                                    <label for="image">Choose an image (jpeg, jpg or png)</label>
                                    <input type="file"
                                           class="form-control-file {{ $errors->has('image') ? 'is-invalid' : '' }}"
                                           id="image"
                                           name="image">
                                    <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <video controls style="width: 100%;" class="mb-3">
                                    <source src="{{ $song->video_url }}" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                                <div class="form-group">
                                    <label for="video">Choose a video (mp4)</label>
                                    <input type="file"
                                           class="form-control-file {{ $errors->has('video') ? 'is-invalid' : '' }}"
                                           id="video"
                                           name="video">
                                    <div class="invalid-feedback">{{ $errors->first('video') }}</div>
                                </div>
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
                                    <div class="form-group">
                                        <label for="track_image_{{ $i }}">Choose a wave image (png)</label>
                                        <input type="file"
                                               class="form-control-file {{ $errors->has("track_image_{$i}") ? 'is-invalid' : '' }}"
                                               id="track_image_{{ $i }}"
                                               name="track_image_{{ $i }}">
                                        <div class="invalid-feedback">{{ $errors->first("track_image_{$i}") }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="track_image_{{ $i }}">Choose an audio file (mp3)</label>
                                        <input type="file"
                                               class="form-control-file {{ $errors->has("track_audio_{$i}") ? 'is-invalid' : '' }}"
                                               id="track_audio_{{ $i }}"
                                               name="track_audio_{{ $i }}">
                                        <div class="invalid-feedback">{{ $errors->first("track_audio_{$i}") }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </form>
@endsection
