<?php
include '../config/database.php';

$countryCode = $_GET['country'];
$language = $_GET['language'];

$stmt = $pdo->prepare("DELETE FROM countrylanguage WHERE CountryCode = :countryCode AND Language = :language");
$stmt->bindParam(':countryCode', $countryCode, PDO::PARAM_STR);
$stmt->bindParam(':language', $language, PDO::PARAM_STR);

if ($stmt->execute()) {
    header('Location: index.php');
} else {
    echo "Error deleting language.";
}
?>
