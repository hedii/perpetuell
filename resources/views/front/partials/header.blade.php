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
                    <p>
                        perpetuell.es est un site hébergeant des paysag.es sonor.es infini.<br>
                        La trame de s.es sons est faite de 8 enregistrements de duré.es différent.es qui se superposent de façon aléatoir.es<br>
                        Si vous souhaitez participer n'hésitez pas à nous écrire : <a href="mailto:contact@perpetuell.es">contact@perpetuell.es</a>
                    </p>
                </div>

                <div class="home-modal-text" id="home-modal-text-2">
                    <p>
                        Là tu .es sur perpetuell.es<br>
                        C'est une sorte de générateur de fond sonores fait à partir de 8 pistes de longueurs différentes qui se lancent plus ou moins aléatoirement.<br>
                        Si tu as envie participer envoie nous un mail et on en parle : <a href="mailto:contact@perpetuell.es">contact@perpetuell.es</a>
                    </p>
                </div>

                <div class="home-modal-text" id="home-modal-text-3">
                    <p>
                        Si vous lisez ces mots c'est que vous êtes tombées sur ce site et vous vous demandez de quoi il s'agit.<br>
                        Nous ne sommes pas en mesure de vous répondre car nous n'en avons aucune idée.<br>
                        Par contre nous avons une adresse mail : <a href="mailto:contact@perpetuell.es">contact@perpetuell.es</a>
                    </p>
                </div>

                <div class="home-modal-text" id="home-modal-text-4">
                    <p>
                        8 pistes de durées différents qui se chevauchent aléatoirement.<br>
                        1 capture vidéo qui se répète indéfiniment.<br>
                        Aucune limitation au temps de diffusion.<br>
                        <a href="mailto:contact@perpetuell.es">contact@perpetuell.es</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
