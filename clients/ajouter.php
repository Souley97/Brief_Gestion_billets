<?php
// Connexion à la base de données
require_once('../traitement/db.php');

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

// Fermer la connexion
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une réservation</title>
    <!-- Inclure les fichiers CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2>Ajouter une réservation</h2>

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
            <button type="submit" class="btn btn-primary">Ajouter réservation</button>
        </form>
    </div>

    <!-- Inclure le fichier JavaScript de Bootstrap (nécessaire pour le modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>