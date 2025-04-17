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
                // header("Location: index_nomenclature.php");
                // exit();
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
        }

        div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #444;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            transition: border 0.3s;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #007BFF;
            outline: none;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        div[style*="color: red;"] {
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>

<body>
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
</body>

</html>