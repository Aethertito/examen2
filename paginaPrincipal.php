    <!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agentes de Valorant</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="navbar">
  <a href="index.html" class="navbar-brand">Valorant Wiki</a>
  <div class="navbar-links">
    <a href="paginaPrincipal.php" class="navbar-link">Agents</a>
    <a href="weapons/weapons.php" class="navbar-link">Weapons</a>
    <a href="basics/maps.php" class="navbar-link">Maps</a>
    <a href="seasons/season.php" class="navbar-link">Seasons</a>
    <a href="weapons/skins.php" class="navbar-link">Skins</a>
    <a href="basics/abilities.php" class="navbar-link">Abilities</a>
  </div>
</div>

<div class="search-filter-container">
  <form method="get">
    <input type="text" name="search" placeholder="Search by agent name">
    <select name="role">
      <option value="">Rol filter</option>
      <option value="Duelist">Duelist</option>
      <option value="Initiator">Initiator</option>
      <option value="Controller">Controller</option>
      <option value="Sentinel">Sentinel</option>
    </select>
    <select name="sort">
      <option value="">Order by</option>
      <option value="az">A-Z</option>
      <option value="za">Z-A</option>
    </select>
    <button type="submit">Buscar</button>
  </form>
</div>

<div id="agentes-lista">
  <?php 
    
    $agentes = [
      ["nombre" => "Gekko", "uuid" => "e370fa57-4757-3604-3648-499e1f642d3f", "rol" => "Initiator"],
      ["nombre" => "Fade", "uuid" => "dade69b4-4f5a-8528-247b-219e5a1facd6", "rol" => "Initiator"],
      ["nombre" => "Viper", "uuid" => "707eab51-4836-f488-046a-cda6bf494859", "rol" => "Controller"],
      ["nombre" => "Sage", "uuid" => "569fdd95-4d10-43ab-ca70-79becc718b46", "rol" => "Sentinel"],
      ["nombre" => "Phoenix", "uuid" => "eb93336a-449b-9c1b-0a54-a891f7921d69", "rol" => "Duelist"],
      ["nombre" => "Brimstone", "uuid" => "9f0d8ba9-4140-b941-57d3-a7ad57c6b417", "rol" => "Controller"],
      ["nombre" => "Cypher", "uuid" => "117ed9e3-49f3-6512-3ccf-0cada7e3823b", "rol" => "Sentinel"],
      ["nombre" => "Sova", "uuid" => "ded3520f-4264-bfed-162d-b080e2abccf9", "rol" => "Initiator"],
      ["nombre" => "Omen", "uuid" => "8e253930-4c05-31dd-1b6c-968525494517", "rol" => "Initiator"],
      ["nombre" => "Jett", "uuid" => "add6443a-41bd-e414-f6ad-e58d267f4e95", "rol" => "Duelist"],
      ["nombre" => "Raze", "uuid" => "f94c3b30-42be-e959-889c-5aa313dba261", "rol" => "Duelist"],
      ["nombre" => "Reyna", "uuid" => "a3bfb853-43b2-7238-a4f1-ad90e9e46bcc", "rol" => "Duelist"],
      ["nombre" => "Killjoy", "uuid" => "1e58de9c-4950-5125-93e9-a0aee9f98746", "rol" => "Sentinel"],
      ["nombre" => "Yoru", "uuid" => "7f94d92c-4234-0a36-9646-3a87eb8b5c89", "rol" => "Duelist"],
      ["nombre" => "Skye", "uuid" => "6f2a04ca-43e0-be17-7f36-b3908627744d", "rol" => "Initiator"],
      ["nombre" => "Astra", "uuid" => "41fb69c1-4189-7b37-f117-bcaf1e96f1bf", "rol" => "Controller"],
      ["nombre" => "KAY/O", "uuid" => "601dbbe7-43ce-be57-2a40-4abd24953621", "rol" => "Initiator"],
      ["nombre" => "Iso", "uuid" => "0e38b510-41a8-5780-5e8f-568b2a4f2d6c", "rol" => "Duelist"],
      ["nombre" => "Neon", "uuid" => "bb2a4828-46eb-8cd1-e765-15848195d751", "rol" => "Duelist"],
      ["nombre" => "Deadlock", "uuid" => "cc8b64c8-4b25-4ff9-6e7f-37b4da43d235", "rol" => "Sentinel"],
      ["nombre" => "Breach", "uuid" => "5f8d3a7f-467b-97f3-062c-13acf203c006", "rol" => "Initiator"],
      ["nombre" => "Chamber", "uuid" => "22697a3d-45bf-8dd7-4fec-84a9e28c69d7", "rol" => "Sentinel"],
      ["nombre" => "Harbor", "uuid" => "95b78ed7-4637-86d9-7e41-71ba8c293152", "rol" => "Controller"]
  ];

    // Función para filtrar agentes por nombre
    function filtrarAgentesPorNombre($agentes, $nombre) {
      $resultados = [];
      foreach ($agentes as $agente) {
          if (strpos(strtolower($agente['nombre']), strtolower($nombre)) !== false) {
              $resultados[] = $agente;
          }
      }
      return $resultados;
    }

    // Función para filtrar agentes por rol
    function filtrarAgentesPorRol($agentes, $rol) {
      $resultados = [];
      foreach ($agentes as $agente) {
          if ($agente['rol'] === $rol) {
              $resultados[] = $agente;
          }
      }
      return $resultados;
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
      $nombreBuscado = $_GET['search'];
      $agentes = filtrarAgentesPorNombre($agentes, $nombreBuscado);
  }

    if (isset($_GET['role'])) {
      $rolFiltrado = $_GET['role'];
      if ($rolFiltrado !== "") {
          $agentes = filtrarAgentesPorRol($agentes, $rolFiltrado);
      }
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

    // Función para imprimir la lista de agentes
    foreach ($agentes as $agente) {
        echo '<div class="agente">';
        echo '<h2>' . $agente["nombre"] . '</h2>';
        echo '<a href="agentes/agente.php?uuid=' . $agente["uuid"] . '">';
        echo '<img src="https://media.valorant-api.com/agents/' . $agente["uuid"] . '/displayicon.png" alt="' . $agente["nombre"] . '" class="agent-img">';
        echo '</a>';
        echo '</div>';
    }
  ?>
</div>

</body>
</html>
