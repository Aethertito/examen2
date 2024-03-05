<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Búsqueda de Habilidades de Agentes en Valorant</title>
  <link rel="stylesheet" href="../styles.css">
  <!-- Incluye aquí tus estilos adicionales -->
</head>
<body>

<div class="navbar">
  <a href="../index.html" class="navbar-brand">Valorant Wiki</a>
  <div class="navbar-links">
    <a href="../paginaPrincipal.php" class="navbar-link">Agents</a>
    <a href="../weapons/weapons.php" class="navbar-link">Weapons</a>
    <a href="maps.php" class="navbar-link">Maps</a>
    <a href="..seasons/season.php" class="navbar-link">Seasons</a>
    <a href="../weapons/skins.php" class="navbar-link">Skins</a>
    <a href="basics/abilities.php" class="navbar-link">Abilities</a>
  </div>
</div>

<div class="container">
  <h1>Búsqueda de Habilidades de Agentes</h1>
  <form action="" method="get">
    <input type="text" name="ability" placeholder="Introduce el nombre de la habilidad" required>
    <button type="submit">Buscar</button>
  </form>

  <?php
  if (isset($_GET['ability']) && $_GET['ability'] != '') {
    $abilityToSearch = strtolower(trim($_GET['ability']));
    $url = "https://valorant-api.com/v1/agents";
    
    $response = file_get_contents($url);
    $agents = json_decode($response, true);

    if ($agents['status'] == 200) {
      $abilitiesFound = [];
      foreach ($agents['data'] as $agent) {
        if (isset($agent['abilities'])) {
          foreach ($agent['abilities'] as $ability) {
            if (stripos(strtolower($ability['displayName']), $abilityToSearch) !== false) {
              $abilitiesFound[] = [
                'agentName' => $agent['displayName'],
                'abilityName' => $ability['displayName'],
                'abilityDescription' => $ability['description'],
                'abilityIcon' => $ability['displayIcon']
              ];
            }
          }
        }
      }

      if (count($abilitiesFound) > 0) {
        echo "<h2>Resultados encontrados:</h2>";
        foreach ($abilitiesFound as $found) {
          echo "<div class='ability-info'>";
          echo "<img src='" . htmlspecialchars($found['abilityIcon']) . "' alt='" . htmlspecialchars($found['abilityName']) . "' style='max-width: 100px;'><br>";
          echo "<strong>Agente:</strong> " . htmlspecialchars($found['agentName']) . "<br>";
          echo "<strong>Habilidad:</strong> " . htmlspecialchars($found['abilityName']) . "<br>";
          echo "<strong>Descripción:</strong> " . htmlspecialchars($found['abilityDescription']);
          echo "</div><hr>";
        }
      } else {
        echo "<p>No se encontraron habilidades que coincidan con tu búsqueda.</p>";
      }
    } else {
      echo "<p>Hubo un problema al obtener los datos de los agentes.</p>";
    }
  }
  ?>
</div>

</body>
</html>
