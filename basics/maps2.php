<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Información de Mapas</title>
  <link rel="stylesheet" href="../styles.css">
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      color: black;
    }
    .container {
      text-align: center;
    }
    img {
      max-width: 100%;
      height: auto;
      margin: 0 auto;
      display: block;
      margin-bottom: 20px;
    }
    .image-selector {
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
    .button-style {
  padding: 12px 24px;
  border: 2px solid transparent;
  border-radius: 8px;
  background-color: #ddd; 
  color: black;
  font-size: 16px;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  cursor: pointer;
  transition: background-color 0.3s, box-shadow 0.3s, border 0.3s;
  margin: 0 8px;
}
.button-style:hover, .button-style:focus {
  background-color: #165ead; 
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  border-color: #143c74; 
}
.button-style:active {
  background-color: #0f4a8d;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.25);
}
  </style>
  <script>
    function updateImage(src) {
      document.getElementById('mapImage').src = src;
    }
  </script>
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
  <?php
  if(isset($_GET['map'])) {
    $map_uuid = $_GET['map'];
    $url = "https://valorant-api.com/v1/maps/".$map_uuid;
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if(isset($data['data'])) {
      $displayName = $data['data']['displayName'];
      $splash = $data['data']['splash'];
      $displayIcon = $data['data']['displayIcon'];
      $listViewIcon = $data['data']['listViewIcon'];
      $listViewIconTall = $data['data']['listViewIconTall'];
      $stylizedBackgroundImage = $data['data']['stylizedBackgroundImage'];
      $premierBackgroundImage = $data['data']['premierBackgroundImage'];
      ?>

      <h2><?php echo $displayName; ?></h2>
      <div class="image-selector">
        <button class="button-style" onclick="updateImage('<?php echo $splash; ?>')">Splash</button>
        <button  class="button-style" onclick="updateImage('<?php echo $displayIcon; ?>')">Display Icon</button>
        <button class="button-style" onclick="updateImage('<?php echo $listViewIcon; ?>')">List View Icon</button>
       <hr>
        <button  class="button-style" onclick="updateImage('<?php echo $listViewIconTall; ?>')">List View Icon Tall</button>
        <button  class="button-style" onclick="updateImage('<?php echo $stylizedBackgroundImage; ?>')">Stylized Background</button>
        <button  class="button-style" onclick="updateImage('<?php echo $premierBackgroundImage; ?>')">Premier Background</button>
      </div>
      <img id="mapImage" src="<?php echo $splash; ?>" alt="<?php echo $displayName; ?>">
      <table>
        <tr>
          <th>Region Name</th>
          <th>Site</th>
        </tr>
        <?php
        $callouts = $data['data']['callouts'];
        foreach ($callouts as $callout) {
          ?>
          <tr>
            <td><?php echo $callout['regionName']; ?></td>
            <td><?php echo $callout['superRegionName']; ?></td>
          </tr>
          <?php
        }
        ?>
      </table>
      <?php
    } else {
      echo "<p>No se encontró información del mapa.</p>";
    }
  } else {
    echo "<p>Debe seleccionar un mapa.</p>";
  }
  ?>
</div>

</body>
</html>
