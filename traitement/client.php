<?php
require_once('db.php');

if (isset($_POST['billet'])) {
    // Récupérer les données du formulaire
    $destination = $_POST['destination'];
    $prix = $_POST['prix'];
    $categorie = $_POST['categorie'];
    // Récupérez les autres données du formulaire selon votre structure de base de données
    $conn = connect();

    // Début de la transaction
    $conn->beginTransaction();
    //id destination prix categorie telephone

    try {
        // Ajouter le client
        $query_client = "INSERT INTO Billet (destination, prix, categorie,) VALUES (:destination, :prix, :categorie )";
        $stmt_client = $conn->prepare($query_client);
        $stmt_client->bindParam(':destination', $destination);
        $stmt_client->bindParam(':prix', $prix);
        $stmt_client->bindParam(':categorie', $categorie);
        $stmt_client->execute();
        $conn->commit();

        echo "Réservation ajoutée avec succès.";
        if ($stmt_client->rowCount() > 0) {
            header('Location: ../clients/index.php');
        }





        // Valider la transaction

    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $conn->rollBack();
        echo "Erreur : " . $e->getMessage();
    }
}