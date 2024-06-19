<?php
include '../config/database.php';
include '../templates/header.php';

$countryCode = isset($_GET['country']) ? $_GET['country'] : '';

$query = "SELECT * FROM city";
if ($countryCode) {
    $query .= " WHERE CountryCode = :countryCode";
}
$stmt = $pdo->prepare($query);
if ($countryCode) {
    $stmt->bindParam(':countryCode', $countryCode, PDO::PARAM_STR);
}
$stmt->execute();
$cities = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Ciudades</h2>
<form method="GET" action="index.php">
    <label for="country">Filtrar por el código del país:</label>
    <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($countryCode); ?>">
    <button type="submit">Filtrar</button>
</form>
<button class="navegation" onclick="location.href='add.php'">Añadir nueva ciudad</button>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Código del país</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cities as $city): ?>
            <tr>
                <td><?php echo htmlspecialchars($city['ID']); ?></td>
                <td><?php echo htmlspecialchars($city['Name']); ?></td>
                <td><?php echo htmlspecialchars($city['CountryCode']); ?></td>
                <td>
                    <a href="show.php?id=<?php echo htmlspecialchars($city['ID']); ?>">Ver</a>
                    <a href="edit.php?id=<?php echo htmlspecialchars($city['ID']); ?>">Editar</a>
                    <a href="delete.php?id=<?php echo htmlspecialchars($city['ID']); ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include '../templates/footer.php'; ?>
