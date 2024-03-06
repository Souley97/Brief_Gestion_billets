<?php


require_once('../traitement/billet.php');

// Connexion à la base de données

// Récupérer les réservations depuis la base de données
$conn = connect();
$query = "SELECT * , Reservation.id AS idR FROM Reservation 
          INNER JOIN Client ON Reservation.id_client = Client.id
          INNER JOIN Billet ON Reservation.id_billet = Billet.id";
$stmt = $conn->prepare($query);
$stmt->execute();
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require_once("../partials/head.php");
require_once("../partials/navbar.php");
// Connexion à la base de données
?>

<div class="container mt-5">
    <h2>Liste des Réservations</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date de Réservation</th>
                <th>Date de Départ</th>
                <th>Heure de Départ</th>
                <th>Statut</th>
                <th>Client</th>
                <th>Billet</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $reservation): ?>
                <tr>
                    <td>
                        <?= $reservation['id']; ?>
                    </td>
                    <td>
                        <?= $reservation['date_reservation']; ?>
                    </td>
                    <td>
                        <?= $reservation['date_depart']; ?>
                    </td>
                    <td>
                        <?= $reservation['heur_depart']; ?>
                    </td>
                    <td>
                        <?= $reservation['statut']; ?>
                    </td>
                    <td>
                        <?= $reservation['nom'] . ' ' . $reservation['prenom']; ?>
                    </td>
                    <td>
                        <?= $reservation['destination']; ?>
                    </td>
                    <td>
                        <button type="button" value="<?= $reservation['idR']; ?>" class="btn btn-primary"
                            data-bs-toggle="modal" data-bs-target="#mreservationModal">

                        </button>
                        <a href="modifier.php?id=<?= $reservation['idR']; ?>" class="btn btn-warning">Modifier</a>
                        <a href="delete.php?id=<?= $reservation['idR']; ?>" <a
                            href="delete.php?id=<?= $reservation['idR']; ?>" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this reservation?')">Delete</a>

                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="container mt-5">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservationModal">
        Ajouter une réservation
    </button>

    <!-- Modal -->

</div>

<?php
// require_once('modifier.php');
require_once('ajouter.php');
?>


<!-- Inclure le fichier JavaScript de Bootstrap (nécessaire pour le modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>