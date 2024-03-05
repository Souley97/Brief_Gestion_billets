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
            <li class="nav-item">
                <a class="nav-link" href="l">
                    <i class="fa fa-calendar"></i>
                    Les Réservations
                </a>
            </li>
        </ul>
    </div>
</nav>
<!-- Contenu de la page -->
<div class="container p mt-5">


    <h1>Bienvenue sur la Plateforme de Réservation de Billets</h1>

    <!-- Système d'affichage des réservations sous forme de cartes (cards) -->
    <div class="card-group">
        <div class="card">
            <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Titre de la Réservation</h5>
                <p class="card-text">Informations sur la réservation.</p>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Titre de la Réservation</h5>
                <p class="card-text">Informations sur la réservation.</p>
            </div>
        </div>
        <div class="card">
            <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Titre de la Réservation</h5>
                <p class="card-text">Informations sur la réservation.</p>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h2>Ajouter une réservation</h2>

    <!-- Bouton pour ouvrir le modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservationModal">
        Ajouter une réservation
    </button>

    <!-- Modal -->
    <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter une réservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulaire d'ajout de réservation -->
                    <form method="post" action="ajouter_reservation.php">
                        <div class="mb-3">
                            <label for="dateReservation" class="form-label">Date de réservation</label>
                            <input type="date" class="form-control" id="dateReservation" name="date_reservation"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="dateDepart" class="form-label">Date de départ</label>
                            <input type="date" class="form-control" id="dateDepart" name="date_depart" required>
                        </div>
                        <div class="mb-3">
                            <label for="heureDepart" class="form-label">Heure de départ</label>
                            <input type="time" class="form-control" id="heureDepart" name="heure_depart" required>
                        </div>
                        <div class="mb-3">
                            <label for="statut" class="form-label">Statut</label>
                            <select class="form-select" id="statut" name="statut" required>
                                <option value="En cours">En cours</option>
                                <option value="Passé">Passé</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="idClient" class="form-label">ID Client</label>
                            <input type="number" class="form-control" id="idClient" name="id_client" required>
                        </div>
                        <div class="mb-3">
                            <label for="idBillet" class="form-label">ID Billet</label>
                            <input type="number" class="form-control" id="idBillet" name="id_billet" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter réservation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<?php

require_once("partials/footer.php");

?>