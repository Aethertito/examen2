<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agentes de Valorant</title>
  <link rel="stylesheet" href="styles.css">
  <style>
  .agentes-lista {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
  }
  
  .compare-checkbox {
    margin-bottom: 10px;
    display: block;
    margin-left: auto;
    margin-right: auto;
  }
  button {
    display: block;
    margin: 20px auto;
  }
  /* Estilo para el nombre del agente */
  .agente h2 {
    font-size: 1rem;
    margin: 0 0 10px;
  }
  /* Elimina estilos adicionales para la tarjeta si existen */
  .agente {
    border: none;
    padding: 0;
    background: none;
    box-shadow: none;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', (event) => {
    const checkboxes = document.querySelectorAll('.compare-checkbox');
    checkboxes.forEach(checkbox => {
      checkbox.addEventListener('change', function() {
        let checkedCheckboxes = document.querySelectorAll('.compare-checkbox:checked');
        if (checkedCheckboxes.length > 2) {
          this.checked = false; // Desmarca el checkbox si ya hay dos seleccionados
          alert("Solo puedes seleccionar dos agentes para comparar.");
        } else if (checkedCheckboxes.length === 2) {
          const rol1 = checkedCheckboxes[0].getAttribute('data-rol');
          const rol2 = checkedCheckboxes[1].getAttribute('data-rol');
          if (rol1 !== rol2) {
            this.checked = false;
            alert("Only can compare agents with same role.");
          }
        }
      });
    });
  });

  function handleCompare() {
    let checkedCheckboxes = document.querySelectorAll('.compare-checkbox:checked');
    if (checkedCheckboxes.length === 2) {
      const agent1 = checkedCheckboxes[0].value;
      const agent2 = checkedCheckboxes[1].value;
      window.location.href = `agentes/comparar.php?agent1=${agent1}&agent2=${agent2}`;
    } else {
      alert("Only select 2 agents with the same role.");
    }
  }
</script>



</head>
<body>
<div class="navbar">
  <a href="index.html" class="navbar-brand">Valorant Wiki</a>
  <div class="navbar-links">
    <a href="paginaPrincipal.php" class="navbar-link">Agents</a>
    <a href="weapons/weapons8.php" class="navbar-link">Weapons</a>
    <a href="basics/maps.php" class="navbar-link">Maps</a>
    <a href="seasons/season.php" class="navbar-link">Seasons</a>
    <a href="weapons/weaponsSkin.php" class="navbar-link">Skins</a>
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
    <button type="submit">Search</button>
  </form>
</div>

<button type="button" onclick="handleCompare()">Comparar</button>

<div id="agentes-lista">
  <?php
   $agentes = [
    ["nombre" => "Gekko", "uuid" => "e370fa57-4757-3604-3648-499e1f642d3f", "rol" => "Initiator","popularidad" => 12],
    ["nombre" => "Fade", "uuid" => "dade69b4-4f5a-8528-247b-219e5a1facd6", "rol" => "Initiator","popularidad" => 8],
    ["nombre" => "Viper", "uuid" => "707eab51-4836-f488-046a-cda6bf494859", "rol" => "Controller","popularidad" => 10],
    ["nombre" => "Sage", "uuid" => "569fdd95-4d10-43ab-ca70-79becc718b46", "rol" => "Sentinel","popularidad" => 16],
    ["nombre" => "Phoenix", "uuid" => "eb93336a-449b-9c1b-0a54-a891f7921d69", "rol" => "Duelist","popularidad" => 9],
    ["nombre" => "Brimstone", "uuid" => "9f0d8ba9-4140-b941-57d3-a7ad57c6b417", "rol" => "Controller","popularidad" => 15],
    ["nombre" => "Cypher", "uuid" => "117ed9e3-49f3-6512-3ccf-0cada7e3823b", "rol" => "Sentinel","popularidad" => 10],
    ["nombre" => "Sova", "uuid" => "ded3520f-4264-bfed-162d-b080e2abccf9", "rol" => "Initiator","popularidad" => 10],
    ["nombre" => "Omen", "uuid" => "8e253930-4c05-31dd-1b6c-968525494517", "rol" => "Initiator","popularidad" => 18],
    ["nombre" => "Jett", "uuid" => "add6443a-41bd-e414-f6ad-e58d267f4e95", "rol" => "Duelist","popularidad" => 20],
    ["nombre" => "Raze", "uuid" => "f94c3b30-42be-e959-889c-5aa313dba261", "rol" => "Duelist","popularidad" => 17],
    ["nombre" => "Reyna", "uuid" => "a3bfb853-43b2-7238-a4f1-ad90e9e46bcc", "rol" => "Duelist","popularidad" => 20],
    ["nombre" => "Killjoy", "uuid" => "1e58de9c-4950-5125-93e9-a0aee9f98746", "rol" => "Sentinel","popularidad" => 15],
    ["nombre" => "Yoru", "uuid" => "7f94d92c-4234-0a36-9646-3a87eb8b5c89", "rol" => "Duelist","popularidad" => 8],
    ["nombre" => "Skye", "uuid" => "6f2a04ca-43e0-be17-7f36-b3908627744d", "rol" => "Initiator","popularidad" => 12],
    ["nombre" => "Astra", "uuid" => "41fb69c1-4189-7b37-f117-bcaf1e96f1bf", "rol" => "Controller","popularidad" => 6],
    ["nombre" => "KAY/O", "uuid" => "601dbbe7-43ce-be57-2a40-4abd24953621", "rol" => "Initiator","popularidad" => 7],
    ["nombre" => "Iso", "uuid" => "0e38b510-41a8-5780-5e8f-568b2a4f2d6c", "rol" => "Duelist","popularidad" => 15],
    ["nombre" => "Neon", "uuid" => "bb2a4828-46eb-8cd1-e765-15848195d751", "rol" => "Duelist","popularidad" => 13],
    ["nombre" => "Deadlock", "uuid" => "cc8b64c8-4b25-4ff9-6e7f-37b4da43d235", "rol" => "Sentinel","popularidad" => 3],
    ["nombre" => "Breach", "uuid" => "5f8d3a7f-467b-97f3-062c-13acf203c006", "rol" => "Initiator","popularidad" => 14],
    ["nombre" => "Chamber", "uuid" => "22697a3d-45bf-8dd7-4fec-84a9e28c69d7", "rol" => "Sentinel","popularidad" => 13],
    ["nombre" => "Harbor", "uuid" => "95b78ed7-4637-86d9-7e41-71ba8c293152", "rol" => "Controller","popularidad" => 9]
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
      foreach ($agentes as $agente) {
        echo '<div class="agente">';
        echo '<h2>' . $agente["nombre"] . '</h2>';
        echo '<input type="checkbox" class="compare-checkbox" data-rol="' . $agente["rol"] . '" value="' . $agente["uuid"] . '">';
        echo '<a href="#" onclick="event.preventDefault(); window.location.href=\'agentes/agente.php?uuid=' . $agente["uuid"] . '\'">';
        echo '<img src="https://media.valorant-api.com/agents/' . $agente["uuid"] . '/displayicon.png" alt="' . $agente["nombre"] . '" class="agent-img">';
        echo '</a>';
        echo '</div>';
    }
    
  ?>
</div>

</body>
</html>
