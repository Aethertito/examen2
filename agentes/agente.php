<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Información del Agente</title>
  <link rel="stylesheet" href="../styles.css">
  <style>
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

<!-- Barra de menú -->
<div class="navbar">
  <a href="#" class="navbar-brand">Valorant Wiki</a>
  <div class="navbar-links">
    <a href="../paginaPrincipal.php" class="navbar-link">Agents</a>
    <a href="#" class="navbar-link">Weapons</a>
  </div>
</div>

<!-- Contenedor principal -->
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
    echo "<h2>Rol</h2>";
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Imagen</th><th>Descripción</th></tr>";
    echo "<tr>";
    echo "<td>{$rol['displayName']}</td>";
    echo "<td><img src='{$rol['displayIcon']}' alt='{$rol['displayName']}'></td>";
    echo "<td>{$rol['description']}</td>";
    echo "</tr>";
    echo "</table>";

    // Mostrar habilidades tabla
    echo "<h2>Habilidades</h2>";
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Imagen</th><th>Descripción</th></tr>";
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
