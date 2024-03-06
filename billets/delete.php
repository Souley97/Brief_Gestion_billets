<?php
require_once('../traitement/db.php');

if (isset($_GET['id'])) {
    $reservation_id = intval($_GET['id']);

    $conn = connect();

    try {
        // Begin the transaction
        $conn->beginTransaction();

        // Delete the reservation
        $query_delete_reservation = "DELETE FROM Billet WHERE id = :id";
        $stmt_delete_reservation = $conn->prepare($query_delete_reservation);
        $stmt_delete_reservation->bindParam(':id', $reservation_id, PDO::PARAM_INT);
        $stmt_delete_reservation->execute();

        // Commit the transaction
        $conn->commit();

        // Redirect the user after deletion
        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        // In case of an error, rollback the transaction
        $conn->rollBack();
        echo "Erreur : " . $e->getMessage();
    }
}

// Rest of your code...
?>