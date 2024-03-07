<div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <div class="mb-3">
                        <label for="pronom" class="form-label">Prenom du client</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse du client</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" required>
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="form-label">Téléphone du client</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" required>
                    </div>

                    <div class="mb-3">
                        <select for="idBillet" name="id_billet" class="form-label" required>

                            <?php
                            require_once '../traitement/db.php';
                            $conn = connect(); // Assurez-vous de définir la connexion avant de l'utiliser
                            
                            $query_billet = "SELECT id, destination FROM Billet";
                            $result = $conn->query($query_billet);
                            $bilets = $result->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($bilets as $bilet): ?>
                                <option class="form-control" id="idBillet" value="<?= $bilet['id'] ?>">
                                    <?= $bilet['destination'] ?>
                                </option>

                            <?php endforeach; ?>

                        </select>



                    </div>
                    <button type="submit" name="reservation" class="btn btn-primary">Ajouter réservation</button>
                </form>
            </div>
        </div>
    </div>
</div>