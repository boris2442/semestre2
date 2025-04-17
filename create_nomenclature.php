<?php
require_once "database/database.php";
require_once "functions/clean_input.php";

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['produits']) && !empty($_POST['quantite']) && !empty($_POST['composants'])) {
        $produits = clean_input($_POST['produits']);
        $quantite = clean_input($_POST['quantite']);
        $composants = clean_input($_POST['composants']);


        if (strlen($produits) > 20) {
            $error = "Le nom du produit est trop long (max 20 caractères).";
        } elseif (!is_numeric($quantite) || intval($quantite) <= 0) {
            $error = "La quantité doit être un nombre entier positif.";
        } else {
            // Insertion dans la database
            $sql = "INSERT INTO nomenclature (quantite, produits, composants) VALUES (:quantite, :produits, :composants)";
            $requete = $db->prepare($sql);
            $requete->bindValue(":quantite", $quantite);
            $requete->bindValue(":produits", $produits);
            $requete->bindValue(":composants", $composants);

            if ($requete->execute()) {
                echo "ok";
                header("Location: index_nomenclature.php");
                exit();
            } else {
                $error = "Erreur lors de l'insertion dans la base de données.";
            }
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une nomenclature</title>
    <link rel="stylesheet" href="style_nomenclature.css">


 
</head>

<body>
 
    <div>
        <button type="button" id="toggleMode">🌗 Changer de mode</button>
    </div>

    <form action="" method="post">
        <h1>Ajouter une nomenclature</h1>
        <?php if (!empty($error)) : ?>
            <div style="color: red;"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <div>
            <label for="produits">Produit</label>
            <input type="text" name="produits" id="produit" maxlength="20" required>
        </div>
        <div>
            <label for="composants">Composant</label>
            <input type="text" name="composants" id="composant" required>
        </div>
        <div>
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" id="quantite" min="1" required>
        </div>
        <div>
            <input type="submit" value="Ajouter">
        </div>
    </form>
    <script>
        const toggleBtn = document.getElementById('toggleMode');
        const body = document.body;

        toggleBtn.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            localStorage.setItem('theme', body.classList.contains('dark-mode') ? 'dark' : 'light');
        });


        window.addEventListener('load', () => {
            if (localStorage.getItem('theme') === 'dark') {
                body.classList.add('dark-mode');
            }
        });
    </script>

</body>

</html>