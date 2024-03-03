<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Información de Mapas</title>
  <link rel="stylesheet" href="../styles.css">
  <style>
    body{
            font-family: Arial,helvetica,arial,sans-serif;
            color: black;
        }
    .container {
      text-align: center;
    }
    img {
      max-width: 70%;
      height: auto;
      margin: 0 auto;
      display: block;
      margin-bottom: 20px;
    }
    table {
      margin: 0 auto;
      border-collapse: collapse;
      width: 50%;
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
  $url = "https://valorant-api.com/v1/maps";
  $response = file_get_contents($url);
  $data = json_decode($response, true);

  if(isset($data['data']) && !empty($data['data'])) {
    foreach ($data['data'] as $map) {
      $displayName = $map['displayName'];
      $splash = $map['splash'];
      $callouts = $map['callouts'];
      ?>

      <h2><?php echo $displayName; ?></h2>
      <!-- Imagen principal del mapa -->
      <img src="<?php echo $splash; ?>" alt="<?php echo $displayName; ?>">

      <!-- Tabla de Callouts -->
      <table>
        <tr>
          <th>Nombre de la Región</th>
          <th>Super Región</th>
        </tr>
        <?php foreach ($callouts as $callout) { ?>
          <tr>
            <td><?php echo $callout['regionName']; ?></td>
            <td><?php echo $callout['superRegionName']; ?></td>
          </tr>
        <?php } ?>
      </table>

      <?php
    }
  } else {
    echo "<p>No se encontró información de mapas.</p>";
  }
  ?>
</div>

</body>
</html>

