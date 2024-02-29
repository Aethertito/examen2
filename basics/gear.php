<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Información del Gear</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>

<!-- Barra de menú -->
<div class="navbar">
  <a href="../index.php" class="navbar-brand">Valorant Wiki</a>
  <div class="navbar-links">
    <a href="../paginaPrincipal.php" class="navbar-link">Agents</a>
    <a href="../weapons/weapons.php" class="navbar-link">Weapons</a>
    <a href="../basics/menuBasics.php" class="navbar-link">Basics</a>
  </div>
</div>

<!-- Contenedor principal -->
<div class="container">
<?php
$url = "https://valorant-api.com/v1/gear";

$response = file_get_contents($url);

if ($response === false) {
  echo "<p>Error al obtener la información del gear.</p>";
} else {
  $data = json_decode($response, true);

  if(isset($data['data']) && !empty($data['data'])) {
    foreach ($data['data'] as $gear) {
      $displayName = $gear['displayName'];
      $description = $gear['description'];
      $displayIcon = $gear['displayIcon'];
      $cost = $gear['shopData']['cost'];

      echo "<h1>$displayName</h1>";
      echo "<img src='$displayIcon' alt='$displayName'>";
      echo "<p>$description</p>";
      echo "<h2>Cost: $cost</h2> <hr>"; 
    }
  } else {
    echo "<p>No se encontró información de gear.</p>";
  }
}
?>

</div>

</body>
</html>
