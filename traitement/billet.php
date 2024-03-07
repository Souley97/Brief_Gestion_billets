<?php
// Connexion à la base de données
require_once('db.php');

if (isset($_POST['reservation'])) {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    // Récupérez les autres données du formulaire selon votre structure de base de données
    $conn = connect();

    // Début de la transaction
    $conn->beginTransaction();
    //id nom prenom	adresse	telephone

    try {
        // Ajouter le client
        $query_client = "INSERT INTO Client (nom, prenom, adresse, telephone) VALUES (:nom, :prenom, :adresse, :telephone)";
        $stmt_client = $conn->prepare($query_client);
        $stmt_client->bindParam(':nom', $nom);
        $stmt_client->bindParam(':prenom', $prenom);
        $stmt_client->bindParam(':adresse', $adresse);
        $stmt_client->bindParam(':telephone', $telephone);
        $stmt_client->execute();

        // Récupérer l'ID du dernier client ajouté
        $id_client = $conn->lastInsertId();
        $id_billet_fictif = $_POST['id_billet'];

        // Ajouter la réservation avec un id_billet fictif, remplacez-le par l'ID réel du billet
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

if (isset($_POST['modifier_reservation'])) {
    // Récupérez les autres données du formulaire
    $nom = strip_tags($_POST['nom']);
    $prenom = strip_tags($_POST['prenom']);

    try {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

        // Effectuez la mise à jour dans la base de données
        $query = "UPDATE Client SET nom = :nom, prenom = :prenom WHERE id = :id";
        $stmt = $conn->prepare($query);
        // Bind les autres valeurs du formulaire
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);

        $stmt->execute();
        $rowsAffected = $stmt->rowCount();

        if ($rowsAffected > 0) {
            // Redirigez l'utilisateur vers la liste des réservations après la modification
            header('Location: ../clients/index.php');
            exit();
        } else {
            echo "Aucune modification effectuée. Vérifiez les données fournies.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

?>