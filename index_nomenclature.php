<?php
require_once "database/database.php";
require_once "functions/clean_input.php";
$sql = "SELECT * FROM nomenclature";
$requete = $db->prepare($sql);
$requete->execute();
$nomenclatures = $requete->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomenclature - Liste</title>
    
    <style>
        :root {
            --bg-color: #ffffff;
            --text-color: #000000;
            --table-bg: #f0f0f0;
            --table-header-bg: #dcdcdc;
            --highlight: #e0e0e0;
        }

        body.dark-mode {
            --bg-color: #121212;
            --text-color: #ffffff;
            --table-bg: #1e1e1e;
            --table-header-bg: #2c2c2c;
            --highlight: #333333;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: 'Segoe UI', sans-serif;
            padding: 2rem;
            transition: background-color 0.3s, color 0.3s;
        }

        h1 {
            text-align: center;
            margin-bottom: 2rem;
        }

        .dark-toggle {
            display: block;
            margin: 0 auto 2rem;
            padding: 0.5rem 1rem;
            cursor: pointer;
            background-color: var(--table-header-bg);
            border: none;
            border-radius: 6px;
            color: var(--text-color);
            transition: background-color 0.3s;
        }

        .dark-toggle:hover {
            background-color: var(--highlight);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: var(--table-bg);
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        th, td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #99999933;
        }

        th {
            background-color: var(--table-header-bg);
        }

        tr:hover {
            background-color: var(--highlight);
        }

        @media (max-width: 600px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            th {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            td {
                position: relative;
                padding-left: 50%;
                border-bottom: 1px solid #444;
            }

            td::before {
                position: absolute;
                top: 12px;
                left: 16px;
                width: 45%;
                white-space: nowrap;
                color: #999;
            }

            td:nth-of-type(1)::before { content: "ID"; }
            td:nth-of-type(2)::before { content: "Quantité"; }
            td:nth-of-type(3)::before { content: "Produits"; }
            td:nth-of-type(4)::before { content: "Composants"; }
        }
       
    </style>
</head>
<body>
<?php
    require_once "functions/navbar.php"
    ?>
    <h1>Liste des nomenclatures</h1>
    <!-- <button class="dark-toggle" onclick="toggleDarkMode()">🌙 Activer/Désactiver le Dark Mode</button> -->

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Quantité</th>
                <th>Produits</th>
                <th>Composants</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($nomenclatures as $nomenclature): ?>
                <tr>
                    <td><?= clean_input($nomenclature['id']) ?? '' ?></td>
                    <td><?= clean_input($nomenclature['quantite']) ?? '' ?></td>
                    <td><?= clean_input($nomenclature['produits']) ?? '' ?></td>
                    <td><?= clean_input($nomenclature['composants']) ?? '' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function toggleDarkMode() {
            document.body.classList.toggle("dark-mode");
            // Enregistrer l'état dans localStorage
            localStorage.setItem('darkMode', document.body.classList.contains("dark-mode"));
        }

        // Appliquer le mode enregistré
        window.onload = function() {
            const savedMode = localStorage.getItem('darkMode') === 'true';
            if (savedMode) {
                document.body.classList.add("dark-mode");
            }
        }
    </script>
</body>
</html>
