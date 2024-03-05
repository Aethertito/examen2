<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Información de Mapas</title>
  <link rel="stylesheet" href="../styles.css">
  <style>
    body {
      font-family: Arial, helvetica, sans-serif;
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
  </style>
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
  $url = "https://valorant-api.com/v1/maps";
  $response = file_get_contents($url);
  $data = json_decode($response, true);

  if(isset($data['data']) && !empty($data['data'])) {
    foreach ($data['data'] as $map) {
      $displayName = $map['displayName'];
      $splash = $map['splash'];
      ?>
      <h2><a href="maps2.php?map=<?php echo $map['uuid']; ?>"><?php echo $displayName; ?></a></h2>
      <a href="maps2.php?map=<?php echo $map['uuid']; ?>"><img src="<?php echo $splash; ?>" alt="<?php echo $displayName; ?>"></a>

      <?php
    }
  } else {
    echo "<p>No se encontró información de mapas.</p>";
  }
  ?>
</div>

</body>
</html>
