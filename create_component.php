<?php
require_once "database/database.php";
require_once "functions/clean_input.php";

if ($_POST) {
    if (
        isset($_POST['libelle'], $_POST['description'], $_POST['cout']) &&  !empty($_POST['libelle']) && !empty(['description']) && !empty(['cout'])
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
    $cout = clean_input(($_POST['cout']));

 
    $sql = "INSERT INTO `composant` (libelle, description,cout) VALUES(:libelle, :description, :cout)";
    $requete = $db->prepare($sql);
    $requete->bindValue(':libelle', $libelle);
    $requete->bindValue(':description', $description);
    $requete->bindValue(':cout', $cout);
    $requete->execute();
}
?>










<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ajout d un composant</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            height: 100vh;
           
            
            background: #f5f7fa;
        }

        form {
            width: 100%;
            max-width: 420px;
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
           margin: 0 auto;
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
    </style>
</head>

<body>
    <?php
    require_once "functions/navbar.php"
    ?>

    <form method="post">
        <h1>Ajouter un composant</h1>

        <div>
            <label for="libelle">Libellé du composant</label>
            <input type="text" id="libelle" name="libelle" required>
        </div>

        <div>
            <label for="cout">Coût du composant</label>
            <input type="text" id="cout" name="cout" required>
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" required></textarea>
        </div>

        <div>
            <input type="submit" value="Envoyer">
        </div>
        <div>
        <a href="index_component.php">← Retour à la liste des produits</a>
    </div>
    </form>
   

</body>

</html>