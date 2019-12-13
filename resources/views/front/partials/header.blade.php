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
</header>

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
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, earum placeat. Aliquid impedit
                        nam nemo odit perferendis? Architecto dolor facere ipsa ipsum modi neque perspiciatis quidem
                        ratione, sapiente sed voluptatum.</p>
                </div>

                <div class="home-modal-text" id="home-modal-text-2">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. itecto dolor facere ipsa ipsum modi
                        neque perspiciatis quidem ratione, sapiente sed voluptatum.</p>
                </div>

                <div class="home-modal-text" id="home-modal-text-3">
                    <p>Lorem ipsumLorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, earum placeat.
                        Aliquid impedit nam nemo odit perferendis? Architecto dolor facere ipsa ipsum modi neque
                        perspiciatis quidem ratione, sapiente sed voluptatum. Dolores, earum placeat. Aliquid impedit
                        nam nemo odit perferendis? Architecto dolor facere ipsa ipsum modi neque perspiciatis quidem
                        ratione, sapiente sed voluptatum.</p>
                </div>

                <div class="home-modal-text" id="home-modal-text-4">
                    <p>Lorem ipsum Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, earum placeat.
                        Aliquid impedit nam nemo odit perferendis? Architecto dolor facere ipsa ipsum modi neque
                        perspiciatis quidem ratione, sapiente sed voluptatum re ipsa ipsum modi neque perspiciatis
                        quidem ratione, sapiente sed voluptatum.</p>
                </div>

                <div class="home-modal-text" id="home-modal-text-5">
                    <p>Lorem ipsum dolor LorLorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, earum
                        placeat. Aliquid impedit nam nemo odit perferendis? Architecto dolor facere ipsa ipsum modi
                        neque perspiciatis quidem ratione, sapiente sed voluptatum Lorem ipsum dolor sit amet,
                        consectetur adipisicing elit. Dolores, earum placeat. Aliquid impedit nam nemo odit perferendis?
                        Architecto dolor facere ipsa ipsum modi neque perspiciatis quidem ratione, sapiente sed
                        voluptatum Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, earum placeat.
                        Aliquid impedit nam nemo odit perferendis? Architecto dolor facere ipsa ipsum modi neque
                        perspiciatis quidem ratione, sapiente sed voluptatum perspiciatis quidem ratione, sapiente sed
                        voluptatum.</p>
                </div>

                <div class="home-modal-text" id="home-modal-text-6">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, earum placeat. Aliquid impedit
                        nam nemo odit perferendis? Architecto dolor facere ipsa ipsum modi neque perspiciatis quidem
                        ratione, sapiente sed voluptatum Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Dolores, earum placeat. Aliquid impedit nam nemo odit perferendis? Architecto dolor facere ipsa
                        ipsum modi neque perspiciatis quidem ratione, sapiente sed voluptatum.</p>
                </div>
            </div>
        </div>
    </div>
</div>
