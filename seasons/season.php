<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seasons</title>
  <link rel="stylesheet" href="../styles2.css">
</head>
<body>

<div class="navbar">
  <a href="../index.html" class="navbar-brand">Valorant Wiki</a>
  <div class="navbar-links">
    <a href="../paginaPrincipal.php" class="navbar-link">Agents</a>
    <a href="../weapons/weapons8.php" class="navbar-link">Weapons</a>
    <a href="../basics/maps.php" class="navbar-link">Maps</a>
    <a href="season.php" class="navbar-link">Seasons</a>
    <a href="../weapons/skins.php" class="navbar-link">Skins</a>
    <a href="../basics/abilities.php" class="navbar-link">Abilities</a>
  </div>
</div>

<div class="container">
  <?php
  $url = "https://valorant-api.com/v1/seasons";

  $response = file_get_contents($url);

  if ($response === false) {
    echo "<p>Error al obtener la información de las temporadas.</p>";
  } else {
    $data = json_decode($response, true);

    if (isset($data['data']) && !empty($data['data'])) {
      // Preparamos los datos agrupándolos por episodios
      $episodes = [];
      foreach ($data['data'] as $item) {
        if (empty($item['type'])) { // Es un episodio
          $episodes[$item['uuid']] = [
            'displayName' => $item['displayName'],
            'acts' => []
          ];
        }
      }

      foreach ($data['data'] as $item) {
        if (!empty($item['type'])) { // Es un acto
          $parentUuid = $item['parentUuid'];
          if (isset($episodes[$parentUuid])) {
            $episodes[$parentUuid]['acts'][] = $item;
          }
        }
      }

      // Mostramos los datos en una tabla
      // ... Resto de tu código PHP ...

// Mostramos los datos en una tabla
echo "<table>";
echo "<tr><th>Episodio</th><th>Acto</th><th>Inicio</th><th>Fin</th></tr>";
foreach ($episodes as $episode) {
  $rowSpan = count($episode['acts']) > 0 ? count($episode['acts']) : 1;
  echo "<tr class='episode-row'>";
  echo "<td rowspan='$rowSpan'>" . $episode['displayName'] . "</td>";
  if ($rowSpan > 1) {
    $firstAct = true;
    foreach ($episode['acts'] as $act) {
      if (!$firstAct) echo "<tr class='act-row'>";
      echo "<td>" . $act['displayName'] . "</td>";
      echo "<td>" . date('d/m/Y', strtotime($act['startTime'])) . "</td>";
      echo "<td>" . date('d/m/Y', strtotime($act['endTime'])) . "</td>";
      echo "</tr>";
      $firstAct = false;
    }
  } else {
    echo "<td colspan='3'>No hay actos disponibles</td></tr>";
  }
}
echo "</table>";
    } else {
      echo "<p>No se encontró información de las temporadas.</p>";
    }
  }
  ?>
</div>

</body>
</html>
