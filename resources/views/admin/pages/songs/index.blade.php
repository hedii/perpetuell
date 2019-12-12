@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12 mb-3">
            <h3>Songs</h3>
            <hr>
            <p>
                <a class="btn btn-primary"
                   href="{{ route('admin.songs.create') }}">
                    Create a new song
                </a>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if($songs->count())
                <div class="table-responsive-sm mb-4">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($songs as $song)
                            <tr>
                                <td scope="row">{{ $song->id }}</td>
                                <td>{{ $song->name }}</td>
                                <td>{{ $song->created_at }}</td>
                                <td>{{ $song->updated_at }}</td>
                                <td>
                                    <a class="btn btn-sm btn-outline-primary"
                                       href="{{ route('admin.songs.edit', $song) }}">
                                        Edit
                                    </a>
                                    <a class="btn btn-sm btn-outline-success"
                                       href="">
                                        Show
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger"
                                            data-toggle="modal"
                                            data-target="#delete-song-modal-{{ $song->id }}">
                                        Delete
                                    </button>
                                    <div id="delete-song-modal-{{ $song->id }}"
                                         class="modal"
                                         tabindex="-1"
                                         role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Are you sure?</h5>
                                                    <button type="button"
                                                            class="close"
                                                            data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Do you really want to delete the song
                                                        <strong>#{{ $song->id }} <em>{{ $song->name }}</em></strong> ?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button"
                                                            class="btn btn-secondary"
                                                            data-dismiss="modal">
                                                        No, cancel
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-danger"
                                                            onclick="event.preventDefault();
                                                                document.getElementById('delete-song-{{ $song->id }}').submit();">
                                                        Yes, I'm sure
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form id="delete-song-{{ $song->id }}"
                                          action="{{ route('admin.songs.destroy', $song) }}"
                                          method="post"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>No songs yet...</p>
            @endif
        </div>
    </div>
@endsection
