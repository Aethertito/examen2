<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Weapons Info</title>
  <link rel="stylesheet" href="../styles.css">
  <style>
    .container{
      font-family: Arial,helvetica,arial,sans-serif;
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
    <a href="weaponsSkin.php" class="navbar-link">Skins</a>
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
if(isset($data['data']) && !empty($data['data'])){
    $name = $data['data']['displayName'];
    $icon = $data['data']['displayIcon'];
if ($data['data']['weaponStats'] == null) {
  echo "<h1>$name</h1>";
  echo "<img src = $icon alt=#>";
  echo "<h1>This weapon doesnt have stats available</h1>";
}else{
  $fr = $data['data']['weaponStats']['fireRate'];
  $ms = $data['data']['weaponStats']['magazineSize'];
  $rt = $data['data']['weaponStats']['reloadTimeSeconds'];
  $wp = $data['data']['weaponStats']['wallPenetration'];

  $wp_full = $data['data']['weaponStats']['wallPenetration'];
  $wp_parts = explode('::', $wp_full);
  $wp = end($wp_parts);
if ($data['data']['weaponStats']['adsStats'] == null) {
  echo "<h1>$name</h1>";
  echo "<img src = $icon alt=#>";
  echo "<h1>Weapon Stats</h1>";
  echo "<h3>Fire rate: $fr</h3>";
  echo "<h3>Magazine Size: $ms</h3>";
  echo "<h3>Reload Time: $rt</h3>";
  echo "<h3>Wall penetration: $wp</h3>";
} else {
  $zm = $data['data']['weaponStats']['adsStats']['zoomMultiplier'];
  $frAds = $data['data']['weaponStats']['adsStats']['fireRate'];
  $rsm = $data['data']['weaponStats']['adsStats']['runSpeedMultiplier'];
    echo "<h1>$name</h1>";
    echo "<img src = $icon alt=#>";
    echo "<h1>Weapon Stats</h1>";
    echo "<h3>Fire rate: $fr</h3>";
    echo "<h3>Magazine Size: $ms</h3>";
    echo "<h3>Reload Time: $rt</h3>";
    echo "<h3>Wall penetration: $wp</h3>";
  
    echo "<h1>Ads Stats</h1>";
    echo "<h3>Zoom multiplier: $zm</h3>";
    echo "<h3>Fire rate: $frAds</h3>";
    echo "<h3>Run Speed Multiplier: $rsm</h3>";
      }
    }
  }
}
?>
  </div>
</body>
</html>