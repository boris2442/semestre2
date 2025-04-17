<?php
require_once "database/database.php";
require_once "functions/clean_input.php";

if ($_POST) {
    if (
        isset($_POST['libelle'], $_POST['description']) &&  !empty($_POST['libelle']) && !empty(['description'])
    ) {

        if (strlen($_POST['libelle'] > 20)) {
            $error = "le nombre de caractere n'excede pas 20";
        }
        $libelle = clean_input($_POST['libelle']);
        if (strlen($_POST['description'] > 200)) {
            $error = "le nombre de caractere n'excede pas 250";
        }
    } else {
        $error = "veuillez remplir tous les champs";
    }
    $description = clean_input($_POST['description']);

    $sql = "INSERT INTO `produits` (libelle, description) VALUES(:libelle, :description)";
    $requete = $db->prepare($sql);
    $requete->bindValue(':libelle', $libelle);
    $requete->bindValue(':description', $description);
    $requete->execute();
}
?>

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "semestre2" ?></title>
  
</head>

<body>

    <form method="post" class="">
        <h1>Ajouter un produit </h1>
        <div>
            <label for="libelle">Entrer le libelle du produit</label>
            <input type="text" id='libele' name="libelle">
        </div>
        <div>
            <label for="description">Entrer la description du produit</label>
            <textarea name="description" id="description"></textarea>
        </div>
        <div>
            <input type="submit" value="Ajouter">
        </div>


        <div><a href="index_produit.php" >retourner a la liste de produits</a> </div>
    </form>
</body>

</html> -->












<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "semestre2" ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form {
            background-color: #fff;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #444;
            font-size: 14px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #1d72b8;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        input[type="submit"]:hover {
            background-color: #155a96;
        }

        a {
            text-align: center;
            display: block;
            margin-top: 10px;
            color: #1d72b8;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <form method="post">
        <h1>Ajouter un produit</h1>
        <div>
            <label for="libelle">Libellé du produit</label>
            <input type="text" id="libelle" name="libelle" required>
        </div>
        <div>
            <label for="description">Description du produit</label>
            <textarea name="description" id="description" rows="4" required></textarea>
        </div>
        <div>
            <input type="submit" value="Ajouter">
        </div>
        <div>
            <a href="index_produit.php">← Retour à la liste des produits</a>
        </div>
    </form>

</body>

</html>
