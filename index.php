<!-- Barre de navigation (Navbar) -->
<?php

require_once("partials/head.php");

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">Réservation Billets</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa fa-home"></i>
                    Accueil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./billets/index.php">
                    <i class="fa fa-ticket"></i>
                    Billets
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./clients/index.php">
                    <i class="fa fa-users"></i>
                    Clients
                </a>
            </li>

        </ul>
    </div>
</nav>
<style>
    body {
        /* From https://css.glass */
        background: rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(14.4px);
        -webkit-backdrop-filter: blur(14.4px);
        border: 1px solid rgba(255, 255, 255, 0.82);
        color: #FE7A15;
    }

    .container {
        padding-top: 50px;
    }

    .banner {
        /* Remplacez par le chemin de votre image de bannière */
        background-size: cover;
        color: #FE7A15;
        text-align: center;
        padding: 100px 0;
        margin-bottom: 30px;
    }

    .proposals,
    .services,
    .offers {
        background: #3011BC;
        color: #FE7A15;
        border: 1px solid #FE7A15;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
        /* From https://css.glass */
        background: #FE7A15;
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(14.4px);
        -webkit-backdrop-filter: blur(14.4px);
        border: 1px solid rgba(255, 255, 255, 0.82);
    }

    .card {
        background: #3011BC;
        color: #FE7A15;
        border: 1px solid #FE7A15;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .card-title span {
        color: #FE7A15;
        font-weight: bold;
    }

    .card-subtitle {
        color: #FE7A15;
    }

    .card-text {
        color: #FE7A15;
    }

    .btn-primary {
        background-color: #FE7A15;
        color: #3011BC;
        border: 1px solid #FE7A15;
    }
</style>
</head>

<body>

    <div class="container">
        <!-- Bannière -->
        <section class="banner">
            <h1>Bienvenue sur Sen DEM DIKK</h1>
            <p>Un voyage à l'intérieur du Sénégal ?</p>
        </section>

        <!-- Proposer -->
        <section class="proposals">
            <h2 class="text-center mb-4">Voyages Découvertes</h2>
            <h2 class="text-center mb-4"><a href="clients/index.php" class=" btn btn-primary">Reservation</a></h2>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Proposition 1 -->
                <div class="col">
                    <div class="card">
                        <img src="public/images/800px-Bus.svg.png" class="card-img-top" alt="Image de la proposition 1">
                        <div class="card-body">
                            <h5 class="card-title">Aventures Extrêmes</h5>
                            <p class="card-text">Offrez-vous une pause bien méritée avec nos séjours relaxants.</p>
                        </div>
                    </div>
                </div>

                <!-- Proposition 2 -->
                <div class="col">
                    <div class="card">
                        <img src="public/images/800px-Bus.svg.png" class="card-img-top" alt="Image de la proposition 2">
                        <div class="card-body">
                            <h5 class="card-title">Aventures Extrêmes</h5>
                            <p class="card-text">pour les amateurs de sensations fortes, nos aventures extrêmes vous
                                réservent des défis palpitants. </p>
                        </div>
                    </div>
                </div>

                <!-- Proposition 3 -->
                <div class="col">
                    <div class="card">
                        <img src="public/images/800px-Bus.svg.png" class="card-img-top" alt="Image de la proposition 3">
                        <div class="card-body">
                            <h5 class="card-title">Séjours Relaxants</h5>
                            <p class="card-text">Offrez-vous une pause bien méritée avec nos séjours relaxants</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php require_once("partials/footer.php"); ?>