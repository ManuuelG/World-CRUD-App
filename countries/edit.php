<?php
include '../config/database.php';
include '../templates/header.php';

$code = $_GET['code'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $continent = $_POST['continent'];
    
    $stmt = $pdo->prepare("UPDATE country SET Name = :name, Continent = :continent WHERE Code = :code");
    $stmt->bindParam(':code', $code, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':continent', $continent, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        header('Location: index.php');
    } else {
        echo "Error updating country.";
    }
} else {
    $stmt = $pdo->prepare("SELECT * FROM country WHERE Code = :code");
    $stmt->bindParam(':code', $code, PDO::PARAM_STR);
    $stmt->execute();
    $country = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<h2>Editar País</h2>
<form method="POST" action="edit.php?code=<?php echo htmlspecialchars($code); ?>">
    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($country['Name']); ?>" required>
    <label for="continent">Continente:</label>
    <input type="text" id="continent" name="continent" value="<?php echo htmlspecialchars($country['Continent']); ?>" required>
    <button type="submit">Actualizar</button>
</form>

<?php include '../templates/footer.php'; ?>
