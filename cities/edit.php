<?php
include '../config/database.php';
include '../templates/header.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $countryCode = $_POST['countryCode'];
    $district = $_POST['district'];
    $population = $_POST['population'];
    
    $stmt = $pdo->prepare("UPDATE city SET Name = :name, CountryCode = :countryCode, District = :district, Population = :population WHERE ID = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':countryCode', $countryCode, PDO::PARAM_STR);
    $stmt->bindParam(':district', $district, PDO::PARAM_STR);
    $stmt->bindParam(':population', $population, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        header('Location: index.php');
    } else {
        echo "Error updating city.";
    }
} else {
    $stmt = $pdo->prepare("SELECT * FROM city WHERE ID = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $city = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<h2>Editar ciudad</h2>
<form method="POST" action="edit.php?id=<?php echo htmlspecialchars($id); ?>">
    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($city['Name']); ?>" required>
    <label for="countryCode">Código del país:</label>
    <input type="text" id="countryCode" name="countryCode" value="<?php echo htmlspecialchars($city['CountryCode']); ?>" required>
    <label for="district">Región:</label>
    <input type="text" id="district" name="district" value="<?php echo htmlspecialchars($city['District']); ?>" required>
    <label for="population">Población:</label>
    <input type="number" id="population" name="population" value="<?php echo htmlspecialchars($city['Population']); ?>" required>
    <button type="submit">Actualizar</button>
</form>

<?php include '../templates/footer.php'; ?>
