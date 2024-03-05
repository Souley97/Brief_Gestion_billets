<?php
// Connexion à la base de données
require_once('../traitement/db.php');
if (isset($_POST['reserv'])) {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    // Récupérez les autres données du formulaire selon votre structure de base de données
    $conn = connect();

    // Début de la transaction
    $conn->beginTransaction();

    try {
        // Ajouter le client
        $query_client = "INSERT INTO cli (nom) VALUES (:nom)";
        $stmt_client = $conn->prepare($query_client);
        $stmt_client->bindParam(':nom', $nom);
        $stmt_client->execute();

        // Récupérer l'ID du dernier client ajouté
        $id_client = $conn->lastInsertId();

        // Ajouter la réservation avec un id_billet fictif, remplacez-le par l'ID réel du billet
        $id_billet_fictif = 1; // Remplacez par l'ID réel du billet
        $query_reservation = "INSERT INTO Reservation (date_reservation, date_depart, heur_depart, statut, id_client, id_billet)
VALUES (NOW(), NOW(), NOW(), 'En cours', :id_client, :id_billet)";
        $stmt_reservation = $conn->prepare($query_reservation);
        $stmt_reservation->bindParam(':id_client', $id_client);
        $stmt_reservation->bindParam(':id_billet', $id_billet_fictif);
        $stmt_reservation->execute();

        // Valider la transaction
        $conn->commit();

        echo "Réservation ajoutée avec succès.";
    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $conn->rollBack();
        echo "Erreur : " . $e->getMessage();
    }
}

// Fermer la connexion
?>




<?php
require_once("../partials/head.php");
require_once("../partials/navbar.php");
// Connexion à la base de données
require_once('../traitement/db.php');

// Récupérer les réservations depuis la base de données
$conn = connect();
$query = "SELECT * FROM Reservation 
          INNER JOIN cli ON Reservation.id_client = cli.id
          INNER JOIN Billet ON Reservation.id_billet = Billet.id";
$stmt = $conn->prepare($query);
$stmt->execute();
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des Réservations</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

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
                            <a href="modifier.php?id=<?= $reservation['id_reservation']; ?>"
                                class="btn btn-warning">Modifier</a>
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
        <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter une réservation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <!-- Formulaire pour ajouter un client, une réservation et un billet -->
                        <form method="post" action="index.php">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom du client</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <!-- <div class="mb-3">
                <label for="adresse" class="form-label">Adresse du client</label>
                <input type="text" class="form-control" id="adresse" name="adresse" required>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone du client</label>
                <input type="text" class="form-control" id="telephone" name="telephone" required>
            </div> -->

                            <div class="mb-3">
                                <label for="idBillet" class="form-label">ID Billet</label>
                                <input type="number" class="form-control" id="idBillet" name="id_billet" required>
                            </div>
                            <button type="submit" name="reserv" class="btn btn-primary">Ajouter réservation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Inclure le fichier JavaScript de Bootstrap (nécessaire pour le modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>