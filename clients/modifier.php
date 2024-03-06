<?php
require_once('../traitement/db.php');

if (isset($_POST['modifier_reservation'])) {
    $reservation_id = isset($_POST['reservation_id']) ? intval($_POST['reservation_id']) : 0;

    $conn = connect();

    try {
        // Update the client's name
        $query_client = "UPDATE Client SET nom = :nom , prenom = :prenom WHERE id = :id";
        $stmt_client = $conn->prepare($query_client);
        $stmt_client->bindParam(':id', $reservation_id, PDO::PARAM_INT);
        $stmt_client->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
        $stmt_client->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $stmt_client->execute();

        // Update the reservation details
        $query_reservation = "UPDATE Reservation SET date_depart = :date_depart, statut = :statut WHERE id = :id";
        $stmt_reservation = $conn->prepare($query_reservation);
        $stmt_reservation->bindParam(':id', $reservation_id, PDO::PARAM_INT);
        $stmt_reservation->bindParam(':date_depart', $_POST['date_depart'], PDO::PARAM_STR);
        $stmt_reservation->bindParam(':statut', $_POST['statut'], PDO::PARAM_STR);

        if ($stmt_reservation->execute()) {
            // Redirect the user to the list of reservations after the modification
            header('Location: index.php');
            exit();
        } else {
            echo "Erreur lors de la modification de la réservation.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

$reservation_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$conn = connect();
$query = "SELECT * FROM Reservation Join Client on Reservation.id_client = Client. id  WHERE Reservation.id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $reservation_id, PDO::PARAM_INT);
$stmt->execute();
$reservation = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reservation) {
    echo "Réservation non trouvée.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier Réservation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2>Modifier Réservation</h2>
        <form method="post" action="modifier.php">
            <input type="hidden" name="reservation_id" value="<?= $reservation['id']; ?>">
            <!-- Ajoutez ici les autres champs du formulaire -->
            <div class="mb-3">
                <label for="date_depart">Date de Départ</label>
                <input type="date" class="form-control" id="date_depart" name="date_depart"
                    value="<?= $reservation['date_depart']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="date_depart">Nom</label>
                <input type="texte" class="form-control" id="date_depart" name="nom" value="<?= $reservation['nom']; ?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="date_depart">Prenom </label>
                <input type="texte" class="form-control" id="date_depart" name="prenom"
                    value="<?= $reservation['prenom']; ?>" required>
            </div>
            <div class="mb-3">
                <select name="statut" id="">
                    <option value="En cours" <?= ($reservation['statut'] == 'En cours') ? 'selected' : ''; ?>>
                        En cours
                    </option>
                    <option value="Passe" <?= ($reservation['statut'] == 'Passe') ? 'selected' : ''; ?>>
                        Passe
                    </option>
                </select>
            </div>
            <button type="submit" name="modifier_reservation" class="btn btn-primary">Modifier la réservation</button>
        </form>
    </div>

</body>

</html>