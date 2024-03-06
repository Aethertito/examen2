<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Weapons Info</title>
  <link rel="stylesheet" href="../styles.css">
  <style>
    .container {
      font-family: Arial, helvetica, arial, sans-serif;
      color: white;
    }
  </style>
</head>
<body>

<div class="navbar">
  <a href="../index.html" class="navbar-brand">Valorant Wiki</a>
  <div class="navbar-links">
    <a href="../paginaPrincipal.php" class="navbar-link">Agents</a>
    <a href="../weapons/weapons8.php" class="navbar-link">Weapons</a>
    <a href="../basics/maps.php" class="navbar-link">Maps</a>
    <a href="../seasons/season.php" class="navbar-link">Seasons</a>
    <a href="skins.php" class="navbar-link">Skins</a>
    <a href="../basics/abilities.php" class="navbar-link">Abilities</a>
  </div>
</div>
<div class="container">
    <?php
    if (isset($_GET['uuid']) && !empty($_GET['uuid'])) {
        $uuid = $_GET['uuid'];
        $url = "https://valorant-api.com/v1/weapons/$uuid";
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (isset($data['data']) && !empty($data['data'])) {
            $weaponUuid = $data['data']['uuid'];
            $weaponName = $data['data']['displayName'];
            $weaponIcon = $data['data']['displayIcon'];
            echo "<h1>$weaponName skins</h1>";
            echo "<img src='$weaponIcon' alt='#'>";

            // Iterar sobre los skins y mostrar sus nombres y UUID
            if (isset($data['data']['skins']) && is_array($data['data']['skins'])) {
                foreach ($data['data']['skins'] as $skin) {
                    if ($skin['contentTierUuid'] == null || $skin['displayIcon'] == null) {
                        echo "";
                    } else {
                        $skinUuid = $skin['uuid'];
                        $skinName = $skin['displayName'];
                        $skinIcon = $skin['displayIcon'];
                        echo "<p>$skinName</p>";
                        echo '<a href="skins2.php?uuid=' . $skinUuid . '">';
echo '<img src="' . $skinIcon . '" alt="#">';
echo '</a>';

                    }
                }
            } else {
                echo "No se encontraron skins para este arma.";
            }
        }
    }
    ?>
</div>
</body>
</html>
