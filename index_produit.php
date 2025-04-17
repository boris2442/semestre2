<?php
require_once "database/database.php";
require_once "functions/clean_input.php";

$sql = "SELECT * FROM `produits`";
$requete = $db->prepare($sql);
$requete->execute();
$produits = $requete->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Listes des produits</title>
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
<?php
    require_once "functions/navbar.php"
    ?>
    <h1>Listes des produits</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Libellé</th>
                <th>Description</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit): ?>
                <tr>
                    <td><?= htmlspecialchars($produit['id']) ?></td>
                    <td><?= htmlspecialchars($produit['libelle']) ?></td>
                    <td><?= htmlspecialchars($produit['description']) ?></td>
                    <td class="actions">
                        <a href="update.php?id=<?= $produit['id'] ?>">Modifier</a>
                    </td>
                    <td class="actions">
                        <a href="delete.php?id=<?= $produit['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div>
        <a href="index_produit.php">Produits</a>
        <a href="index_component.php">Composants</a>
        <a href="index_nomenclature.php">Nomenclature</a>
    </div>
</body>

</html>