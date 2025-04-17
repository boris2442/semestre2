<?php
// require "database/database.php";

// if (isset($_GET['id'])) {
//     $id = $_GET['id'];

//     $sql = "DELETE FROM `produits` WHERE id = :id";
//     $requete = $db->prepare($sql);
//     $requete->bindValue(":id", $id);
//     $requete->execute();


//     header("Location: index_produit.php");
//     exit(); 
// } else {
//     echo "ID non retrouvé";
// }












require "database/database.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Supprimer les enregistrements dépendants dans la table nomenclature
    $sql1 = "DELETE FROM `nomenclature` WHERE id_produit = :id";
    $requete1 = $db->prepare($sql1);
    $requete1->bindValue(":id", $id);
    $requete1->execute();

    // Supprimer le produit
    $sql2 = "DELETE FROM `produits` WHERE id = :id";
    $requete2 = $db->prepare($sql2);
    $requete2->bindValue(":id", $id);
    $requete2->execute();

    // Rediriger sans echo avant
    header("Location: index_produit.php");
    exit(); 
} else {
    echo "ID non retrouvé";
}
?>

