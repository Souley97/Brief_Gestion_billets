<?php
// Connexion à la base de données
require_once('traitement/db.php');
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