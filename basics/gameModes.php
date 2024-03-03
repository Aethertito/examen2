<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modos de Juego de Valorant</title>
    <link rel="stylesheet" href="../styles.css">

    <style>
        body{
            font-family: Arial,helvetica,arial,sans-serif;
            color: black;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
        <!-- Barra de menú -->
<div class="navbar">
  <a href="../index.php" class="navbar-brand">Valorant Wiki</a>
  <div class="navbar-links">
    <a href="../paginaPrincipal.php" class="navbar-link">Agents</a>
    <a href="../weapons/weapons.php" class="navbar-link">Weapons</a>
    <a href="../basics/menuBasics.php" class="navbar-link">Basics</a>
  </div>
</div>
    <h2>Modos de Juego de Valorant</h2>
    <table>
        <thead>
            <tr>
                <th>Modo de Juego</th>
                <th>Duración</th>
                <th>Permite Tiempos de Espera</th>
                <th>Voz de Equipo</th>
                <th>Orbes</th>
                </tr>
        </thead>
        <tbody>
            <?php
            $url = 'https://valorant-api.com/v1/gamemodes';
            $json_data = file_get_contents($url);
            $data = json_decode($json_data, true);

            if ($data && isset($data['data']) && count($data['data']) > 0) {
                foreach ($data['data'] as $modo) {
                    echo '<tr>';
                    echo '<td>' . $modo['displayName'] . '</td>';
                    echo '<td>' . $modo['duration'] . '</td>';
                    echo '<td>' . ($modo['allowsMatchTimeouts'] ? 'Sí' : 'No') . '</td>';
                    echo '<td>' . ($modo['isTeamVoiceAllowed'] ? 'Sí' : 'No') . '</td>';
                    echo '<td>' . $modo['orbCount'] . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="6">No hay datos disponibles.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</body>
</html>
