<?php
require_once "database/database.php";
require_once "functions/clean_input.php";

$error = "";
$id = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `produits` WHERE id = :id";
    $requete = $db->prepare($sql);
    $requete->bindValue(':id', $id);
    $requete->execute();
    $produit = $requete->fetch();
}

if (isset($_POST['update'])) {
    if (isset($_POST['libelle'], $_POST['description'])) {
        $libelle = clean_input($_POST['libelle']);
        $description = clean_input($_POST['description']);

        // Vérification des longueurs
        if (strlen($libelle) > 20) {
            $error = "Le libellé ne doit pas dépasser 20 caractères.";
        } elseif (strlen($description) > 200) {
            $error = "La description ne doit pas dépasser 200 caractères.";
        } else {
            // Mise à jour dans la base de données
            $sql = "UPDATE `produits` SET libelle = :libelle, description = :description WHERE id = :id";
            $requete = $db->prepare($sql);
            $requete->execute([
                "libelle" => $libelle,
                "description" => $description,
                "id" => $id
            ]);

            // Redirection après mise à jour
            header("Location: index_produit.php");
            exit();
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
    <title><?= $title ?? "Modifier un produit" ?></title>
    <style>
        /* Styles inchangés */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f5f7fa;
        }

        form {
            width: 100%;
            max-width: 420px;
            padding: 30px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #555;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 0.95rem;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #007BFF;
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-size: 0.9rem;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>

<body>
    <form action="" method="post">
        <h1>Modifier un produit</h1>
        <?php if (!empty($error)) : ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <div>
            <label for="libelle">Entrer le libellé du produit</label>
            <input type="text" id="libelle" name="libelle" value="<?= htmlspecialchars($produit['libelle'] ?? '') ?>">
        </div>
        <div>
            <label for="description">Entrer la description du produit</label>
            <textarea name="description" id="description"><?= htmlspecialchars($produit['description'] ?? '') ?></textarea>
        </div>
        <div>
            <input type="submit" value="Modifier" name="update">
        </div>
        <div>
            <a href="index_produit.php">Liste des produits</a>
        </div>
    </form>
</body>

</html>