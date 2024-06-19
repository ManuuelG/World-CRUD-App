<?php
include '../config/database.php';
include '../templates/header.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM city WHERE ID = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$city = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<h2>Detalles de la ciudad</h2>
<p>ID: <?php echo htmlspecialchars($city['ID']); ?></p>
<p>Nombre: <?php echo htmlspecialchars($city['Name']); ?></p>
<p>Código del país: <?php echo htmlspecialchars($city['CountryCode']); ?></p>
<p>Región: <?php echo htmlspecialchars($city['District']); ?></p>
<p>Población: <?php echo htmlspecialchars($city['Population']); ?></p>

<?php include '../templates/footer.php'; ?>
