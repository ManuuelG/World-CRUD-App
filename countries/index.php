<?php
include '../config/database.php';
include '../templates/header.php';

$continent = isset($_GET['continent']) ? $_GET['continent'] : '';

$query = "SELECT * FROM country";
if ($continent) {
    $query .= " WHERE Continent = :continent";
}
$stmt = $pdo->prepare($query);
if ($continent) {
    $stmt->bindParam(':continent', $continent, PDO::PARAM_STR);
}
$stmt->execute();
$countries = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Países</h2>
<form method="GET" action="index.php">
    <label for="continent">Filtrar por Continente:</label>
    <input type="text" id="continent" name="continent" value="<?php echo htmlspecialchars($continent); ?>">
    <button type="submit">Filtrar</button>
</form>
<button class="navegation" onclick="location.href='add.php'">Añadir nuevo país</button>
<table>
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Continente</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($countries as $country): ?>
            <tr>
                <td><?php echo htmlspecialchars($country['Code']); ?></td>
                <td><?php echo htmlspecialchars($country['Name']); ?></td>
                <td><?php echo htmlspecialchars($country['Continent']); ?></td>
                <td>
                    <a href="show.php?code=<?php echo htmlspecialchars($country['Code']); ?>">Ver</a>
                    <a href="edit.php?code=<?php echo htmlspecialchars($country['Code']); ?>">Editar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include '../templates/footer.php'; ?>
