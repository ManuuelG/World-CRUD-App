<?php
include '../config/database.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM city WHERE ID = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    header('Location: index.php');
} else {
    echo "Error deleting city.";
}
?>
