<?php
include '../config/database.php';
include '../templates/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $countryCode = $_POST['countryCode'];
    $district = $_POST['district'];
    $population = $_POST['population'];
    
    $stmt = $pdo->prepare("INSERT INTO city (Name, CountryCode, District, Population) VALUES (:name, :countryCode, :district, :population)");
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':countryCode', $countryCode, PDO::PARAM_STR);
    $stmt->bindParam(':district', $district, PDO::PARAM_STR);
    $stmt->bindParam(':population', $population, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        header('Location: index.php');
    } else {
        echo "Error adding city.";
    }
}
?>

<h2>Añadir ciudad</h2>
<form method="POST" action="add.php">
    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" required>
    <label for="countryCode">Código del País:</label>
    <input type="text" id="countryCode" name="countryCode" required>
    <label for="district">Región:</label>
    <input type="text" id="district" name="district" required>
    <label for="population">Población:</label>
    <input type="number" id="population" name="population" required>
    <button type="submit">Añadir</button>
</form>

<?php include '../templates/footer.php'; ?>
