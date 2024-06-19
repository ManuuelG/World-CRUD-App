<?php
include '../config/database.php';
include '../templates/header.php';

$code = $_GET['code'];

$stmt = $pdo->prepare("SELECT * FROM country WHERE Code = :code");
$stmt->bindParam(':code', $code, PDO::PARAM_STR);
$stmt->execute();
$country = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<h2>Detalles del País</h2>
<p>Codigo: <?php echo htmlspecialchars($country['Code']); ?></p>
<p>Nombre: <?php echo htmlspecialchars($country['Name']); ?></p>
<p>Continente: <?php echo htmlspecialchars($country['Continent']); ?></p>

<?php include '../templates/footer.php'; ?>
