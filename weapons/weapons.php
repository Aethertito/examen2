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
    <a href="weapons.php" class="navbar-link">Weapons</a>
    <a href="../basics/menuBasics.php" class="navbar-link">Basics</a>
  </div>
</div>
<div class="container">
  <h1>Weapons</h1>
  <?php
//$uuid = $_GET['data']['uuid'];
$url = "https://valorant-api.com/v1/weapons";
$response = file_get_contents($url);
$data = json_decode($response, true);

    // Función para filtrar agentes por nombre
    function filtrarAgentesPorNombre($agentes, $nombre) {
        // Código para filtrar agentes por nombre aquí
    }

    // Función para filtrar agentes por rol
    function filtrarAgentesPorRol($agentes, $rol) {
        // Código para filtrar agentes por rol aquí
    }

    // Función para ordenar agentes de A a Z
    function ordenarAgentesAZ($a, $b) {
        return strcmp($a["nombre"], $b["nombre"]);
    }

    // Función para ordenar agentes de Z a A
    function ordenarAgentesZA($a, $b) {
        return strcmp($b["nombre"], $a["nombre"]);
    }

    // Aplicar filtros y ordenamiento si se han enviado datos desde el formulario
    if (isset($_GET['search'])) {
        // Código para aplicar filtro por nombre aquí
    }

    if (isset($_GET['role'])) {
        // Código para aplicar filtro por rol aquí
    }

    if (isset($_GET['sort'])) {
        $sortType = $_GET['sort'];
        switch ($sortType) {
            case 'az':
                usort($agentes, 'ordenarAgentesAZ');
                break;
            case 'za':
                usort($agentes, 'ordenarAgentesZA');
                break;
            default:
                // No se aplica ningún ordenamiento
                break;
        }
    }
if (isset($data['data']) && is_array($data['data']) && !empty($data['data'])) {
    foreach ($data['data'] as $weapon) {
        if (isset($weapon['displayName'], $weapon['displayIcon'], $weapon['weaponStats']['fireRate'], $weapon['weaponStats']['magazineSize'], $weapon['weaponStats']['reloadTimeSeconds'], $weapon['weaponStats']['firstBulletAccuracy'], $weapon['weaponStats']['wallPenetration'])) {
            $weaponName = $weapon['displayName'];
            $weaponImg = $weapon['displayIcon'];
            $statsFr = $weapon['weaponStats']['fireRate'];
            $statsMs = $weapon['weaponStats']['magazineSize'];
            $statsRt = $weapon['weaponStats']['reloadTimeSeconds'];
            $statsFba = $weapon['weaponStats']['firstBulletAccuracy'];
            $statsWp = $weapon['weaponStats']['wallPenetration'];

            echo "<h1>$weaponName</h1>";
            echo "<img src=$weaponImg>";
            //echo "<h3>$statsFr</h3>";
            // Puedes usar $statsFr, $statsMs, $statsRt, $statsFba, $statsWp aquí
        } else {
            echo "<br>Datos incompletos para el arma.";
        }
    }
} else {
    echo "No se encontraron datos de armas.";
}
?>

</div>
</div>
</body>
</html>