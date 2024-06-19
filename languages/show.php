<?php
include '../config/database.php';
include '../templates/header.php';

$countryCode = $_GET['country'];
$language = $_GET['language'];

$stmt = $pdo->prepare("SELECT * FROM countrylanguage WHERE CountryCode = :countryCode AND Language = :language");
$stmt->bindParam(':countryCode', $countryCode, PDO::PARAM_STR);
$stmt->bindParam(':language', $language, PDO::PARAM_STR);
$stmt->execute();
$languageDetails = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<h2>Detalles del idioma</h2>
<p>Código del país: <?php echo htmlspecialchars($languageDetails['CountryCode']); ?></p>
<p>Idioma: <?php echo htmlspecialchars($languageDetails['Language']); ?></p>
<p>¿Es oficial?: <?php echo htmlspecialchars($languageDetails['IsOfficial']); ?></p>
<p>Porcentaje: <?php echo htmlspecialchars($languageDetails['Percentage']); ?></p>

<?php include '../templates/footer.php'; ?>
