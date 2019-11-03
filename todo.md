Toutes les pistes démarrent en meme temps au debut.

 Pour chaque piste, on commence la piste à un endroit aléatoire.
 
 On fait un fondu au chargement de la page pour le démarrage de chaque piste pour éviter de démarrer sur une crête.
 
 La valuer loopDelay est de 8 secondes au debut.
 
 Lorsque la premiere arrive au bout de sa durée, on attend 8 secondes (= loopDelay) avant de reprendre sa lecture.
 On ajoute 1 secondes à loopDelay.
 
 Lorsqu'une autre piste se termine, on attend loopDelay secondes avant de la recommencer.
 
 On ajoute 1 seconde à loopDelay.
 
 etc...
 
 Il faut jamais qu'il n'y ait aucune piste en lecture.

 On affiche l'onde uniquement des piste qui sont actuellement en lecture.
