<?php
require "database/database.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $sql = "DELETE FROM `composant` WHERE id = :id";
    $requete = $db->prepare($sql);
    $requete->bindParam(":id", $id);

    if ($requete->execute()) {
        
        header("Location: index_component.php");
        exit();
    } else {
  
        echo "Erreur : impossible de supprimer le composant.";
    }
} else {
    echo "ID non fourni.";
}