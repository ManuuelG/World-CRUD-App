<?php
include '../config/database.php';
include '../templates/header.php';

$countryCode = $_GET['country'];
$language = $_GET['language'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isOfficial = $_POST['isOfficial'];
    $percentage = $_POST['percentage'];
    
    $stmt = $pdo->prepare("UPDATE countrylanguage SET IsOfficial = :isOfficial, Percentage = :percentage WHERE CountryCode = :countryCode AND Language = :language");
    $stmt->bindParam(':countryCode', $countryCode, PDO::PARAM_STR);
    $stmt->bindParam(':language', $language, PDO::PARAM_STR);
    $stmt->bindParam(':isOfficial', $isOfficial, PDO::PARAM_STR);
    $stmt->bindParam(':percentage', $percentage, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        header('Location: index.php');
    } else {
        echo "Error updating language.";
    }
} else {
    $stmt = $pdo->prepare("SELECT * FROM countrylanguage WHERE CountryCode = :countryCode AND Language = :language");
    $stmt->bindParam(':countryCode', $countryCode, PDO::PARAM_STR);
    $stmt->bindParam(':language', $language, PDO::PARAM_STR);
    $stmt->execute();
    $languageDetails = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<h2>Editar idioma</h2>
<form method="POST" action="edit.php?country=<?php echo htmlspecialchars($countryCode); ?>&language=<?php echo htmlspecialchars($language); ?>">
    <label for="isOfficial">¿Es oficial?:</label>
    <input type="text" id="isOfficial" name="isOfficial" value="<?php echo htmlspecialchars($languageDetails['IsOfficial']); ?>" required>
    <label for="percentage">Porcentaje:</label>
    <input type="text" id="percentage" name="percentage" value="<?php echo htmlspecialchars($languageDetails['Percentage']); ?>" required>
    <button type="submit">Actualizar</button>
</form>

<?php include '../templates/footer.php'; ?>
