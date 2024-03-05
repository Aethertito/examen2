<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Información del Agente</title>
  <link rel="stylesheet" href="../styles.css">
  <style>
    body{
            font-family: Arial,helvetica,arial,sans-serif;
            color: black;
        }
    /* Estilo para la tabla */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
<div class="navbar">
  <a href="../index.html" class="navbar-brand">Valorant Wiki</a>
  <div class="navbar-links">
    <a href="../paginaPrincipal.php" class="navbar-link">Agents</a>
    <a href="../weapons/weapons.php" class="navbar-link">Weapons</a>
    <a href="../basics/maps.php" class="navbar-link">Maps</a>
    <a href="../seasons/season.php" class="navbar-link">Seasons</a>
    <a href="../weapons/skins.php" class="navbar-link">Skins</a>
    <a href="../basics/abilities.php" class="navbar-link">Abilities</a>
  </div>
</div>

<div class="container">
<?php
if(isset($_GET['uuid']) && !empty($_GET['uuid'])) {
  $uuid = $_GET['uuid'];
  $url = "https://valorant-api.com/v1/agents/$uuid";
  $response = file_get_contents($url);
  $data = json_decode($response, true);

  if(isset($data['data']) && !empty($data['data'])) {
    $nombre = $data['data']['displayName'];
    $descripcion = $data['data']['description'];
    $imagen = $data['data']['fullPortrait'];
    $rol = $data['data']['role'];
    $habilidades = $data['data']['abilities'];
    
    echo "<h1>$nombre</h1>";
    echo "<img src='$imagen' alt='$nombre'>";
    echo "<p>$descripcion</p>";

    // Mostrar información del rol tabla
    echo "<h2>Role</h2>";
    echo "<table>";
    echo "<tr><th>Name</th><th>Image</th><th>Description</th></tr>";
    echo "<tr>";
    echo "<td>{$rol['displayName']}</td>";
    echo "<td><img src='{$rol['displayIcon']}' alt='{$rol['displayName']}'></td>";
    echo "<td>{$rol['description']}</td>";
    echo "</tr>";
    echo "</table>";

    // Mostrar habilidades tabla
    echo "<h2>Abilities</h2>";
    echo "<table>";
    echo "<tr><th>Name</th><th>Image</th><th>Description</th></tr>";
    foreach ($habilidades as $habilidad) {
      echo "<tr>";
      echo "<td>{$habilidad['displayName']}</td>";
      echo "<td><img src='{$habilidad['displayIcon']}' alt='{$habilidad['displayName']}'></td>";
      echo "<td>{$habilidad['description']}</td>";
      echo "</tr>";
    }
    echo "</table>";
  } else {
    echo "<p>No se encontró información para el agente con UUID: $uuid</p>";
  }
} else {
  echo "<p>No se proporcionó un UUID válido en la URL.</p>";
}
?>


</div>

</body>
</html>
