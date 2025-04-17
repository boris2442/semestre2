<?php
require_once "database/database.php";
require_once "functions/clean_input.php";

$sql = "SELECT * FROM `composant`";
$requete = $db->prepare($sql);
$requete->execute();
$composants = $requete->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Listes des composants</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }

        .actions a {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <h1>Listes des composants</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Libellé</th>
                <th>Description</th>
                <th>Coût</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($composants as $composant): ?>
                <tr>
                    <td><?= clean_input($composant['id']) ?></td>
                    <td><?= clean_input($composant['libelle']) ?></td>
                    <td><?= clean_input($composant['description']) ?></td>
                    <td><?= clean_input($composant['cout']) ?></td>
                    <td class="actions">
                        <a href="update_component.php?id=<?= $composant['id'] ?>">Modifier</a>
                    </td>
                    <td class="actions">
                        <a href="delete_component.php?id=<?= $composant['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce composant ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div>
        <a href="index_produit.php">Produits</a>
        <a href="index_component.php">Composants</a>
        <a href="create_nomenclature.php">Nomenclature</a>
    </div>
</body>

</html>