<?php
include '../config/database.php';
include '../templates/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $countryCode = $_POST['countryCode'];
    $language = $_POST['language'];
    $isOfficial = $_POST['isOfficial'];
    $percentage = $_POST['percentage'];
    
    $stmt = $pdo->prepare("INSERT INTO countrylanguage (CountryCode, Language, IsOfficial, Percentage) VALUES (:countryCode, :language, :isOfficial, :percentage)");
    $stmt->bindParam(':countryCode', $countryCode, PDO::PARAM_STR);
    $stmt->bindParam(':language', $language, PDO::PARAM_STR);
    $stmt->bindParam(':isOfficial', $isOfficial, PDO::PARAM_STR);
    $stmt->bindParam(':percentage', $percentage, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        header('Location: index.php');
    } else {
        echo "Error adding language.";
    }
}
?>

<h2>Añadir idioma</h2>
<form method="POST" action="add.php">
    <label for="countryCode">Código del país:</label>
    <input type="text" id="countryCode" name="countryCode" required>
    <label for="language">Idioma:</label>
    <input type="text" id="language" name="language" required>
    <label for="isOfficial">¿Es oficial?:</label>
    <input type="text" id="isOfficial" name="isOfficial" required>
    <label for="percentage">Porcentaje:</label>
    <input type="text" id="percentage" name="percentage" required>
    <button type="submit">Añadir</button>
</form>

<?php include '../templates/footer.php'; ?>
