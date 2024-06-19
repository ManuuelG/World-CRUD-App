<?php
include '../config/database.php';
include '../templates/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $continent = $_POST['continent'];
    
    $stmt = $pdo->prepare("INSERT INTO country (Code, Name, Continent) VALUES (:code, :name, :continent)");
    $stmt->bindParam(':code', $code, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':continent', $continent, PDO::PARAM_STR);
    
    if ($stmt->execute()) {
        header('Location: index.php');
    } else {
        echo "Error adding country.";
    }
}
?>

<h2>Añadir País</h2>
<form method="POST" action="add.php">
    <label for="code">Codigo:</label>
    <input type="text" id="code" name="code" required>
    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" required>
    <label for="continent">Continente:</label>
    <input type="text" id="continent" name="continent" required>
    <button type="submit">Añadir</button>
</form>

<?php include '../templates/footer.php'; ?>
