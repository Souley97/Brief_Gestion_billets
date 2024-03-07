<?php
require_once('../traitement/db.php');

if (isset($_POST['modifier_billet'])) {
    // Récupérer les données du formulaire
    $billet_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $conn = connect();

    $destination = strip_tags($_POST['destination']);
    $prix = strip_tags($_POST['prix']);
    $categorie = strip_tags($_POST['categorie']);

    // Validation: Check if required fields are not empty
    if (empty($destination) || empty($prix) || empty($categorie)) {
        echo "Veuillez remplir tous les champs.";
        exit();
    }

    // Début de la transaction
    $conn->beginTransaction();

    try {
        // Effectuez la mise à jour dans la base de données
        $query = "UPDATE Billet SET destination = :destination, prix = :prix, categorie = :categorie WHERE id = :id";
        $stmt = $conn->prepare($query);
        // Bind les autres valeurs du formulaire
        $stmt->bindParam(':id', $billet_id, PDO::PARAM_INT);
        $stmt->bindParam(':destination', $destination, PDO::PARAM_STR);
        $stmt->bindParam(':prix', $prix, PDO::PARAM_STR);
        $stmt->bindParam(':categorie', $categorie, PDO::PARAM_STR);

        $stmt->execute();

        // Valider la transaction
        $conn->commit();
        echo "Billet modifié avec succès.";
        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        // En cas d'erreur, annuler la transaction
        $conn->rollBack();
        echo "Erreur lors de la modification du billet : " . $e->getMessage();
    }
}


$billet_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$conn = connect();
$query = "SELECT * FROM Billet WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $billet_id, PDO::PARAM_INT);
$stmt->execute();
$billet = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$billet) {
    echo "Billet non trouvé.";
    exit();
}
?>
<?php require_once("../partials/head.php");
require_once("../partials/navbar.php");
// Connexion à la base de données
?>



<div class="container mt-5">
    <h2>Modifier Réservation</h2>
    <form method="post" action="modifier.php">
        <input type="hidden" name="id" value="<?= $billet['id']; ?>">
        <!-- Ajoutez ici les autres champs du formulaire -->
        <div class="mb-3">
            <label for="destination">Date de Départ</label>
            <input type="texte" class="form-control" id="destination" name="destination"
                value="<?= $billet['destination']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="date_depart">Prix</label>
            <input type="texte" class="form-control" id="date_depart" name="prix" value="<?= $billet['prix']; ?>"
                required>
        </div>

        <div class="mb-3">
            <select name="categorie" id="">
                <option value="Simple" <?= ($billet['categorie'] == 'Simple') ? 'selected' : ''; ?>>
                    Simple
                </option>
                <option value="Vip" <?= ($billet['categorie'] == 'Vip') ? 'selected' : ''; ?>>
                    Vip
                </option>
            </select>
        </div>
        <button type="submit" name="modifier_billet" class="btn btn-primary">Modifier la réservation</button>
    </form>
</div>
<!-- Inclure le fichier JavaScript de Bootstrap (nécessaire pour le modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>