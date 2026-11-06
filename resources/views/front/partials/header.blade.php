<header class="site-header container mt-3 mb-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <a href="{{ route('front.songs.index') }}">
                <h1>
                    <img src="{{ asset('images/logo-perpetuelles.png') }}"
                         alt="{{ config('app.name') }}"
                         class="site-logo">
                </h1>
            </a>
        </div>
    </div>
    @if(Route::is('front.songs.index'))
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="#"
                   id="home-modal-link">
                    <img src="{{ asset('images/3points.png') }}"
                         alt="3 points"
                         class="three-point">
                </a>
            </div>
        </div>
    @endif
</header>

@if(Route::is('front.songs.index'))
    <div class="modal fade"
         id="home-modal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="homeModal"
         aria-hidden="true">
        <div class="modal-dialog"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <img src="{{ asset('images/close.png') }}" alt="close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="home-modal-text" id="home-modal-text-1">
                        <p>
                            ni queues ni têtes, ni dieux ni maîtres, ni début ni fin
                        </p>
                    </div>

                    <div class="home-modal-text" id="home-modal-text-2">
                        <p>
                            Nơi nào có sự quan tâm, nơi đó sự chân thành im lặng
                        </p>
                    </div>

                    <div class="home-modal-text" id="home-modal-text-3">
                        <p>
                            the end is the beginning and the beginning is the end
                        </p>
                    </div>

                    <div class="home-modal-text" id="home-modal-text-4">
                        <p>
                            contact: <a href="mailto:ltseeney@gmail.com">ltseeney@gmail.com</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
