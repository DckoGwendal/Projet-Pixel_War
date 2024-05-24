<?php
include ("config.php");
EstConnecte();

/* indique au navigateur ou au client HTTP que le contenu renvoyé par le serveur est de type JSON */
header('Content-Type: application/json');

$query = "SELECT id, Nom FROM grids WHERE Idusers = ?";
$stmt = $link->prepare($query);
$stmt->bind_param("i", $_SESSION['userId']); // Supprimez l'espace dans le nom de la clé
$stmt->execute();
$result = $stmt->get_result(); 
/* extrait tous les enregistrements du résultat sous forme de tableau associatif où les clés sont les noms des colonnes de la base de données */
$grids = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($grids); /* encode le tableau $grids en une chaîne JSON et l'envoie */
?>
