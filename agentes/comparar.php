<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Compare your agents</title>
  <link rel="stylesheet" href="../styles.css">
  <style>
    body {
      background-color: #ffe8e8; 
    }
    .comparison-container {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      flex-wrap: wrap;
      gap: 20px; 
      margin: 20px;
    }
    .agent-container {
      flex: 1; 
      max-width: calc(100% - 40px);
      text-align: center;
      background-color: gray; 
      border: 1px solid #ddd; 
      padding: 20px;
      border-radius: 8px; 
      box-shadow: 0 2px 5px rgba(0,0,0,0.1); 
    }
    img.agent-image {
      width: 150px; 
      height: auto;
      border-radius: 50%; 
      margin-top: 10px;
    }
    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
    .separator {
      flex-basis: 100%; 
      height: 1px;
      background-color: #ddd;
      margin: 20px 0;
    }
  </style>
</head>
<body>
<div class="navbar">
        <a href="../index.html" class="navbar-brand">Valorant Wiki</a>
      </div>

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

function getAgentInfo($uuid) {
    $url = "https://valorant-api.com/v1/agents/$uuid";
    $response = file_get_contents($url);
    return json_decode($response, true);
}
function getAllAgents() {
    $url = "https://valorant-api.com/v1/agents?isPlayableCharacter=true";
    $response = file_get_contents($url);
    return json_decode($response, true);
}

function printSelect($agents, $selectedUuid, $role, $agentNumber) {
    $agentParam = $agentNumber == 'agent1' ? 'agent2' : 'agent1';
    echo "<select id='{$agentNumber}-select' onchange='changeAgent(\"{$agentNumber}\")'>";
    foreach ($agents['data'] as $agent) {
        if ($agent['role']['displayName'] == $role['displayName']) {
            $selected = $agent['uuid'] == $selectedUuid ? "selected" : "";
            echo "<option value='{$agent['uuid']}' {$selected}>{$agent['displayName']}</option>";
        }
    }
    echo "</select>";
}
$allAgents = getAllAgents();
$agent1_data = null;
$agent2_data = null;

function printAgentDetails($data, $agentes) {
    if(isset($data['data']) && !empty($data['data'])) {
        $nombre = $data['data']['displayName'];
        $descripcion = $data['data']['description'];
        $imagen = $data['data']['fullPortrait'];
        $rol = $data['data']['role'];
        $habilidades = $data['data']['abilities'];
        $popularidad = array_values(array_filter($agentes, function($agente) use ($data) {
            return $agente['uuid'] == $data['data']['uuid'];
        }))[0]['popularidad'] ?? 'Desconocido';

    
        echo "<div class='agent-container'>";
        echo "<img class='agent-image' src='$imagen' alt='$nombre' style='width:400px;'>";
        echo "<h2>Role</h2>";
        echo "<p>{$rol['displayName']}</p>";
        echo "<img src='{$rol['displayIcon']}' alt='{$rol['displayName']}' style='width:50px;'>"; 
        echo "<p>{$rol['description']}</p>";
        echo "<h2>Abilities</h2>";
        echo "<p>Popularity: {$popularidad}</p>";
        
        // Tabla para las habilidades
        echo "<table>";
        foreach ($habilidades as $habilidad) {
          echo "<tr><td>{$habilidad['displayName']}</td><td>{$habilidad['description']}</td></tr>";
        }
        echo "</table>";
        echo "</div>";
      } else {
        echo "<p>No info .</p>";
      }
    }

if(isset($_GET['agent1'], $_GET['agent2'])) {
  $agent1_data = getAgentInfo($_GET['agent1']);
  $agent2_data = getAgentInfo($_GET['agent2']);

  // Aquí mostramos los selectores y el mensaje de popularidad
  if ($agent1_data['data']['role']['displayName'] === $agent2_data['data']['role']['displayName']) {
    echo "<div class='selector-container' style='text-align: center;'>";
    printSelect($allAgents, $_GET['agent1'], $agent1_data['data']['role'], 'agent1');
    printSelect($allAgents, $_GET['agent2'], $agent2_data['data']['role'], 'agent2');
    echo "</div>";

    $agent1_popularity = $agentes[array_search($_GET['agent1'], array_column($agentes, 'uuid'))]['popularidad'];
    $agent2_popularity = $agentes[array_search($_GET['agent2'], array_column($agentes, 'uuid'))]['popularidad'];

    $popularityMessage = "";
    if ($agent1_popularity > $agent2_popularity) {
        $popularityMessage = "<span style='display: inline-block; margin-left: 800px;'>" . 
        htmlspecialchars($agent1_data['data']['displayName']) . 
        " is more popular than " . 
        htmlspecialchars($agent2_data['data']['displayName']) . 
        ".</span>";
    } elseif ($agent1_popularity < $agent2_popularity) {
        $popularityMessage = "<span style='display: inline-block; margin-left: 800px;'>" . 
        htmlspecialchars($agent2_data['data']['displayName']) . 
        " is more popular than " . 
        htmlspecialchars($agent1_data['data']['displayName']) . 
        ".</span>";
    } else {
      $popularityMessage = "Both agents have the same popularity.";
    }
    
    echo "<p style='font-size: 1.5em; margin-top: 0; margin-bottom: 20px;'>$popularityMessage</p>";
  } else {
    echo "<pBoth agent should be the same role.</p>";
  }
}
?>

<div class="comparison-container">
  <?php
    if(isset($agent1_data, $agent2_data)) {
      printAgentDetails($agent1_data, $agentes);
      printAgentDetails($agent2_data, $agentes);
    }
  ?>
</div>

<script>
  function changeAgent(agentNumber) {
    var agent1Select = document.getElementById('agent1-select');
    var agent2Select = document.getElementById('agent2-select');
    var agent1Value = agent1Select ? agent1Select.value : "<?php echo $_GET['agent1']; ?>";
    var agent2Value = agent2Select ? agent2Select.value : "<?php echo $_GET['agent2']; ?>";
    var baseUrl = "comparar.php";
    var newUrl = baseUrl + "?agent1=" + agent1Value + "&agent2=" + agent2Value;
    window.location.href = newUrl;
  }
</script>
</body>
</html>