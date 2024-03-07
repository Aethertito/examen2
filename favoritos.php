<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agentes Favoritos - Valorant</title>
  <link rel="stylesheet" href="styles.css">
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

<div id="agentes-lista" class="agentes-lista">
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
    
    foreach ($agentes as $agente) {
      echo '<div class="agente" style="display: none;" data-uuid="' . $agente["uuid"] . '">';
      echo '<h2>' . $agente["nombre"] . '</h2>';
      echo '<a href="#" onclick="event.preventDefault(); window.location.href=\'agentes/agente.php?uuid=' . $agente["uuid"] . '\'">';
      echo '<img src="https://media.valorant-api.com/agents/' . $agente["uuid"] . '/displayicon.png" alt="' . $agente["nombre"] . '" class="agent-img">';
      echo '</a>';
      echo '<button class="btn-eliminar-favoritos" data-uuid="' . $agente["uuid"] . '">Eliminar de Favoritos</button>';
      echo '</div>';
    }
  ?>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const agentes = document.querySelectorAll('.agente');
    let favoritos = localStorage.getItem('agentesFavoritos');
    favoritos = favoritos ? JSON.parse(favoritos) : [];

    agentes.forEach(agente => {
      if(favoritos.includes(agente.getAttribute('data-uuid'))) {
        agente.style.display = 'block';
      }
    });

    document.querySelectorAll('.btn-eliminar-favoritos').forEach(btn => {
      btn.addEventListener('click', function() {
        const uuid = this.getAttribute('data-uuid');
        const nuevosFavoritos = favoritos.filter(favUuid => favUuid !== uuid);
        localStorage.setItem('agentesFavoritos', JSON.stringify(nuevosFavoritos));
        document.querySelector(`.agente[data-uuid="${uuid}"]`).style.display = 'none';
      });
    });
  });
</script>

</body>
</html>
