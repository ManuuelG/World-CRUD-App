<?php
include '../config/database.php';
include '../templates/header.php';

$countryCode = isset($_GET['country']) ? $_GET['country'] : '';

$query = "SELECT * FROM countrylanguage";
if ($countryCode) {
    $query .= " WHERE CountryCode = :countryCode";
}
$stmt = $pdo->prepare($query);
if ($countryCode) {
    $stmt->bindParam(':countryCode', $countryCode, PDO::PARAM_STR);
}
$stmt->execute();
$languages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Idiomas</h2>
<form method="GET" action="index.php">
    <label for="country">Filtrar por el código del país:</label>
    <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($countryCode); ?>">
    <button type="submit">Filtrar</button>
</form>
<button class="navegation" onclick="location.href='add.php'">Añadir nuevo idioma</button>
<table>
    <thead>
        <tr>
            <th>Código del país</th>
            <th>Idioma</th>
            <th>¿Es oficial?</th>
            <th>Porcentaje</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($languages as $language): ?>
            <tr>
                <td><?php echo htmlspecialchars($language['CountryCode']); ?></td>
                <td><?php echo htmlspecialchars($language['Language']); ?></td>
                <td><?php echo htmlspecialchars($language['IsOfficial']); ?></td>
                <td><?php echo htmlspecialchars($language['Percentage']); ?></td>
                <td>
                    <a href="show.php?country=<?php echo htmlspecialchars($language['CountryCode']); ?>&language=<?php echo htmlspecialchars($language['Language']); ?>">View</a>
                    <a href="edit.php?country=<?php echo htmlspecialchars($language['CountryCode']); ?>&language=<?php echo htmlspecialchars($language['Language']); ?>">Edit</a>
                    <a href="delete.php?country=<?php echo htmlspecialchars($language['CountryCode']); ?>&language=<?php echo htmlspecialchars($language['Language']); ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include '../templates/footer.php'; ?>
