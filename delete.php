<?php

require "database/database.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

   
    $sql1 = "DELETE FROM `nomenclature` WHERE id= :id";
    $requete1 = $db->prepare($sql1);
    $requete1->bindValue(":id", $id);
    $requete1->execute();


    $sql2 = "DELETE FROM `produits` WHERE id = :id";
    $requete2 = $db->prepare($sql2);
    $requete2->bindValue(":id", $id);
    $requete2->execute();

  
    header("Location: index_produit.php");
    exit(); 
} else {
    echo "ID non retrouvé";
}
?>

