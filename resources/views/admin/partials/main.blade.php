<main class="admin-main container py-5">
    @if(session()->has('status'))
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {!! session()->get('status') !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
    @yield('content')
</main>
