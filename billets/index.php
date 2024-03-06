<!DOCTYPE html>
<html lang="en">
<?php
require_once('../traitement/db.php');


if (isset($_POST['ajouter_billet'])) {
    // Récupérer les données du formulaire
    $destination = $_POST['destination'];
    $prix = $_POST['prix'];
    $categorie = $_POST['categorie'];

    // Récupérez les autres données du formulaire selon votre structure de base de données
    $conn = connect();

    // Début de la transaction
    $conn->beginTransaction();

    try {
        // Ajouter le billet
        $query_billet = "INSERT INTO Billet (destination, prix, categorie) VALUES (:destination, :prix, :categorie)";
        $stmt_billet = $conn->prepare($query_billet);
        $stmt_billet->bindParam(':destination', $destination);
        $stmt_billet->bindParam(':prix', $prix);
        $stmt_billet->bindParam(':categorie', $categorie);
        $stmt_billet->execute();

        // Valider la transaction
        $conn->commit();

        echo "Billet ajouté avec succès.";
        header('Location: /index.php');
        exit();
    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $conn->rollBack();
        echo "Erreur : " . $e->getMessage();
    }
}
?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une réservation</title>
    <!-- Inclure les fichiers CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    require_once("../traitement/db.php");
    // Connexion à la base de données
    $conn = connect();
    $query = "SELECT * FROM Billet ";

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

                    <th>Destination</th>
                    <th>Prix</th>
                    <th>Categorie</th>
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
                            <?= $reservation['destination']; ?>
                        </td>
                        <td>
                            <?= $reservation['prix']; ?>
                        </td>
                        <td>
                            <?= $reservation['categorie']; ?>
                        </td>
                        <td>
                            <a href="modifier.php?id=<?= $reservation['id']; ?>" class="btn btn-warning">Modifier</a>
                            <a href="delete.php?id=<?= $reservation['id']; ?>" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this reservation?')">Delete</a>

                        </td>
                    <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <div class="container mt-5">
        <!-- Bouton pour ouvrir le modal -->
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
                                <label for="destination" class="form-label">Destination</label>
                                <input type="text" class="form-control" id="destination" name="destination" required>
                            </div>
                            <div class="mb-3">
                                <label for="prix" class="form-label">Prix</label>
                                <input type="text" class="form-control" id="prix" name="prix" required>
                            </div>
                            <select name="categorie" id="">
                                <option value="Simple" <?= ($reservation['categorie'] == 'Simple') ? 'selected' : ''; ?>>
                                    Simple
                                </option>
                                <option value="Vip" <?= ($reservation['categorie'] == 'Vip') ? 'selected' : ''; ?>>
                                    Vip
                                </option>
                            </select>


                            <button type="submit" name="ajouter_billet" class="btn btn-primary">Ajouter
                                réservation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inclure le fichier JavaScript de Bootstrap (nécessaire pour le modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>