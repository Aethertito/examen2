<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Abilities</title>
  <link rel="stylesheet" href="../styles.css">
  <style>
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      text-align: center;
    }
    .search-form {
      margin-bottom: 20px;
    }
    .ability-info, .agent-info {
      text-align: left;
      margin-bottom: 10px;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: gray;
    }
    .ability-info img, .agent-info img {
      width: 50px;
      height: 50px;
      margin-right: 10px;
      vertical-align: middle;
    }
    .not-found {
      color: #ff0000;
    }
  </style>
</head>
<body>

<div class="navbar">
  <a href="../index.html" class="navbar-brand">Valorant Wiki</a>
  <div class="navbar-links">
    <a href="../paginaPrincipal.php" class="navbar-link">Agents</a>
    <a href="../weapons/weapons.php" class="navbar-link">Weapons</a>
    <a href="maps.php" class="navbar-link">Maps</a>
    <a href="../seasons/season.php" class="navbar-link">Seasons</a>
    <a href="../weapons/skins.php" class="navbar-link">Skins</a>
    <a href="basics/abilities.php" class="navbar-link">Abilities</a>
  </div>
</div>
<hr>
<div class="container">
  <h1>Search Abilities or Agents</h1>
  <form action="" method="get" class="search-form">
    <input type="text" name="search" placeholder="Agent or abilitie name" required>
    <button type="submit">Buscar</button>
  </form>

  <?php
  if (isset($_GET['search']) && $_GET['search'] != '') {
    $searchTerm = strtolower(trim($_GET['search']));
    $url = "https://valorant-api.com/v1/agents";

    $response = file_get_contents($url);
    $agents = json_decode($response, true);

    if ($agents['status'] == 200) {
      $resultsFound = false;

      foreach ($agents['data'] as $agent) {
        // Búsqueda por nombre de agente
        if (stripos(strtolower($agent['displayName']), $searchTerm) !== false) {
          echo "<h2>Agente: " . htmlspecialchars($agent['displayName']) . "</h2>";
          foreach ($agent['abilities'] as $ability) {
            echo "<div class='ability-info'>";
            echo "<img src='" . htmlspecialchars($ability['displayIcon']) . "' alt='" . htmlspecialchars($ability['displayName']) . "' style='width: 50px; vertical-align: middle;'>";
            echo "<strong>" . htmlspecialchars($ability['displayName']) . ":</strong> ";
            echo htmlspecialchars($ability['description']);
            echo "</div><br>";
          }
          $resultsFound = true;
        }

        // Búsqueda por nombre de habilidad
        foreach ($agent['abilities'] as $ability) {
          if (!$resultsFound && stripos(strtolower($ability['displayName']), $searchTerm) !== false) {
            echo "<div class='ability-info'>";
            echo "<img src='" . htmlspecialchars($ability['displayIcon']) . "' alt='" . htmlspecialchars($ability['displayName']) . "' style='width: 50px; vertical-align: middle;'>";
            echo "<strong>Abilitie:</strong> " . htmlspecialchars($ability['displayName']) . "<br>";
            echo "<strong>Agent:</strong> " . htmlspecialchars($agent['displayName']) . "<br>";
            echo "<strong>Description:</strong> " . htmlspecialchars($ability['description']);
            echo "</div><hr>";
            $resultsFound = true;
          }
        }
      }

      if (!$resultsFound) {
        echo "<p>No skills or agents found that match your search.</p>";
      }
    } else {
      echo "<p>Error.</p>";
    }
  }
  ?>
</div>

</body>
</html>
