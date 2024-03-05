<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Información de Mapas</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>


<div class="navbar">
  <a href="../index.html" class="navbar-brand">Valorant Wiki</a>
  <div class="navbar-links">
    <a href="../paginaPrincipal.php" class="navbar-link">Agents</a>
    <a href="../weapons/weapons.php" class="navbar-link">Weapons</a>
    <a href="../basics/menuBasics.php" class="navbar-link">Basics</a>
  </div>
</div>

<div class="container">
  <!-- Formulario de búsqueda -->
  <div class="search-container">
    <form action="" method="get">
      <input type="text" placeholder="Buscar por nombre..." name="search" class="search-input" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
      <select name="sort" onchange="this.form.submit()">
        <option value="">Ordenar por</option>
        <option value="az" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'az' ? 'selected' : ''; ?>>A-Z</option>
        <option value="za" <?php echo isset($_GET['sort']) && $_GET['sort'] === 'za' ? 'selected' : ''; ?>>Z-A</option>
      </select>
      <button type="submit" class="search-button">Buscar</button>
    </form>
  </div>
  <hr>

  <?php
  // Funciones de ordenamiento
  function ordenarMapasAZ($a, $b) {
      return strcmp($a["displayName"], $b["displayName"]);
  }

  function ordenarMapasZA($a, $b) {
      return strcmp($b["displayName"], $a["displayName"]);
  }

  // Obtención y filtrado de datos
  $url = "https://valorant-api.com/v1/maps";
  $response = file_get_contents($url);
  $data = json_decode($response, true);
  $search = isset($_GET['search']) ? strtolower($_GET['search']) : '';

  if (isset($data['data']) && !empty($data['data'])) {
      // Filtrar los mapas por nombre de búsqueda
      $filtered_maps = array_filter($data['data'], function($map) use ($search) {
          return empty($search) || strpos(strtolower($map['displayName']), $search) !== false;
      });

      // Ordenar si se especificó un criterio
      if (isset($_GET['sort'])) {
          $sortType = $_GET['sort'];
          if ($sortType == 'az') {
              usort($filtered_maps, 'ordenarMapasAZ');
          } elseif ($sortType == 'za') {
              usort($filtered_maps, 'ordenarMapasZA');
          }
      }

      // Mostrar los mapas
      foreach ($filtered_maps as $map) {
          $displayName = $map['displayName'];
          $splash = $map['splash'];
          ?>
          <h2><a href="maps2.php?map=<?php echo $map['uuid']; ?>"><?php echo $displayName; ?></a></h2>
          <a href="maps2.php?map=<?php echo $map['uuid']; ?>"><img src="<?php echo $splash; ?>" alt="<?php echo $displayName; ?>"></a>
          <hr>
          <?php
      }
  } else {
      echo "<p>No se encontró información de mapas.</p>";
  }
  ?>
</div>

</body>
</html>
