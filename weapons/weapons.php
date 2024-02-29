<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Información del Agente</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>

<!-- Barra de menú -->
<div class="navbar">
  <a href="../index.php" class="navbar-brand">Valorant Wiki</a>
  <div class="navbar-links">
    <a href="../paginaPrincipal.php" class="navbar-link">Agents</a>
    <a href="weapons.php" class="navbar-link">Weapons</a>
  </div>
</div>
<?php
  $url = "https://valorant-api.com/v1/weapons";
  $response = file_get_contents($url);
  $data = json_decode($response, true);
foreach ($data['data'] as $weapon) {
    echo $weapon['displayName']."<br>";
    echo "<img src='".$weapon['displayIcon']."'>"."</a> <br>";
}

?>


</div>

</body>
</html>