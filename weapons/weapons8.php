<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Valorant Weapons</title>
  <link rel="stylesheet" href="../styles.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #1a1a1a;
      font-family: 'Arial', sans-serif;
      color: white;
    }
    .menu-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 50px;
    }
    .weapon-category {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 30px;
    }
    .weapon-card {
      background: #2a2a2a;
      border: 1px solid #3a3a3a;
      border-radius: 5px;
      width: 180px;
      padding: 10px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    .weapon-card:hover {
      transform: scale(1.1);
    }
    .weapon-image {
      width: 100%;
      height: auto;
    }
    .weapon-name {
      text-align: center;
      margin-top: 10px;
      color: #ddd;
    }
    .category-title {
      width: 100%;
      text-align: center;
      font-size: 1.5em;
      margin: 20px 0;
    }
    .category-title span {
      background: #333;
      padding: 5px 15px;
      border-radius: 15px;
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

<div class="search-filter-container">
  <form method="get">
    <input type="text" name="search" placeholder="Search a weapon...">
    <select name="category">
      <option value="">Filter by category</option>
      <option value="Heavy">Heavy</option>
      <option value="Rifle">Rifle</option>
      <option value="Sidearm">Sidearm</option>
      <option value="Shotgun">Shotgun</option>
      <option value="Sniper">Sniper</option>
      <option value="SMG">SMG</option>
      <option value="Melee">Melee</option>
    </select>
    <select name="sort">
      <option value="">Order by</option>
      <option value="az">A-Z</option>
      <option value="za">Z-A</option>
    </select>
    <button type="submit">Search</button>
  </form>
</div>


<div class="menu-container">
  <div class="weapon-category">
  <?php 
    // Datos de los agentes (simulación)
    $weapons = [
      ["nombre" => "Odin", "uuid" => "63e6c2b6-4a8e-869c-3d4c-e38355226584", "category" => "Heavy", "newImage" => "https://media.valorant-api.com/weapons/63e6c2b6-4a8e-869c-3d4c-e38355226584/shop/newimage.png"],
      ["nombre" => "Ares", "uuid" => "55d8a0f4-4274-ca67-fe2c-06ab45efdf58", "category" => "Heavy", "newImage" => "https://media.valorant-api.com/weapons/55d8a0f4-4274-ca67-fe2c-06ab45efdf58/shop/newimage.png"],
      ["nombre" => "Vandal", "uuid" => "9c82e19d-4575-0200-1a81-3eacf00cf872", "category" => "Rifle", "newImage" => "https://media.valorant-api.com/weapons/9c82e19d-4575-0200-1a81-3eacf00cf872/shop/newimage.png"],
      ["nombre" => "Bulldog", "uuid" => "ae3de142-4d85-2547-dd26-4e90bed35cf7", "category" => "Rifle", "newImage" => "https://media.valorant-api.com/weapons/ae3de142-4d85-2547-dd26-4e90bed35cf7/shop/newimage.png"],
      ["nombre" => "Phantom", "uuid" => "ee8e8d15-496b-07ac-e5f6-8fae5d4c7b1a", "category" => "Rifle", "newImage" => "https://media.valorant-api.com/weapons/ee8e8d15-496b-07ac-e5f6-8fae5d4c7b1a/shop/newimage.png"],
      ["nombre" => "Judge", "uuid" => "ec845bf4-4f79-ddda-a3da-0db3774b2794", "category" => "Shotgun", "newImage" => "https://media.valorant-api.com/weapons/ec845bf4-4f79-ddda-a3da-0db3774b2794/shop/newimage.png"],
      ["nombre" => "Bucky", "uuid" => "910be174-449b-c412-ab22-d0873436b21b", "category" => "Shotgun", "newImage" => "https://media.valorant-api.com/weapons/910be174-449b-c412-ab22-d0873436b21b/shop/newimage.png"],
      ["nombre" => "Frenzy", "uuid" => "44d4e95c-4157-0037-81b2-17841bf2e8e3", "category" => "Sidearm", "newImage" => "https://media.valorant-api.com/weapons/44d4e95c-4157-0037-81b2-17841bf2e8e3/shop/newimage.png"],
      ["nombre" => "Classic", "uuid" => "29a0cfab-485b-f5d5-779a-b59f85e204a8", "category" => "Sidearm", "newImage" => "https://media.valorant-api.com/weapons/29a0cfab-485b-f5d5-779a-b59f85e204a8/shop/newimage.png"],
      ["nombre" => "Ghost", "uuid" => "1baa85b4-4c70-1284-64bb-6481dfc3bb4e", "category" => "Sidearm", "newImage" => "https://media.valorant-api.com/weapons/1baa85b4-4c70-1284-64bb-6481dfc3bb4e/shop/newimage.png"],
      ["nombre" => "Sheriff", "uuid" => "e336c6b8-418d-9340-d77f-7a9e4cfe0702", "category" => "Sidearm", "newImage" => "https://media.valorant-api.com/weapons/e336c6b8-418d-9340-d77f-7a9e4cfe0702/shop/newimage.png"],
      ["nombre" => "Shorty", "uuid" => "42da8ccc-40d5-affc-beec-15aa47b42eda", "category" => "Sidearm", "newImage" => "https://media.valorant-api.com/weapons/42da8ccc-40d5-affc-beec-15aa47b42eda/shop/newimage.png"],
      ["nombre" => "Operator", "uuid" => "a03b24d3-4319-996d-0f8c-94bbfba1dfc7", "category" => "Sniper", "newImage" => "https://media.valorant-api.com/weapons/a03b24d3-4319-996d-0f8c-94bbfba1dfc7/shop/newimage.png"],
      ["nombre" => "Guardian", "uuid" => "4ade7faa-4cf1-8376-95ef-39884480959b", "category" => "Rifle", "newImage" => "https://media.valorant-api.com/weapons/4ade7faa-4cf1-8376-95ef-39884480959b/shop/newimage.png"],
      ["nombre" => "Outlaw", "uuid" => "5f0aaf7a-4289-3998-d5ff-eb9a5cf7ef5c", "category" => "Sniper", "newImage" => "https://media.valorant-api.com/weapons/5f0aaf7a-4289-3998-d5ff-eb9a5cf7ef5c/shop/newimage.png"],
      ["nombre" => "Marshal", "uuid" => "c4883e50-4494-202c-3ec3-6b8a9284f00b", "category" => "Sniper", "newImage" => "https://media.valorant-api.com/weapons/c4883e50-4494-202c-3ec3-6b8a9284f00b/shop/newimage.png"],
      ["nombre" => "Spectre", "uuid" => "462080d1-4035-2937-7c09-27aa2a5c27a7", "category" => "SMG", "newImage" => "https://media.valorant-api.com/weapons/462080d1-4035-2937-7c09-27aa2a5c27a7/shop/newimage.png"],
      ["nombre" => "Stinger", "uuid" => "f7e1b454-4ad4-1063-ec0a-159e56b58941", "category" => "SMG", "newImage" => "https://media.valorant-api.com/weapons/f7e1b454-4ad4-1063-ec0a-159e56b58941/shop/newimage.png"],
      ["nombre" => "Melee", "uuid" => "2f59173c-4bed-b6c3-2191-dea9b58be9c7", "category" => "Melee", "newImage" => "https://media.valorant-api.com/weapons/2f59173c-4bed-b6c3-2191-dea9b58be9c7/displayicon.png"],
    ];
      // Función para filtrar agentes por nombre
      function filtrarArmasPorNombre($weapons, $nombre) {
        $resultados = [];
        foreach ($weapons as $weapons) {
            if (strpos(strtolower($weapons['nombre']), strtolower($nombre)) !== false) {
                $resultados[] = $weapons;
            }
        }
        return $resultados;
    }
 // Función para filtrar agentes por rol
 function filtrarArmasPorCategoria($weapons, $category) {
  $resultados = [];
  foreach ($weapons as $weapon) {
      if ($weapon['category'] === $category) {
          $resultados[] = $weapon;
      }
  }
  return $resultados;
}
    // Función para ordenar agentes de A a Z
    function ordenarArmasAZ($a, $b) {
        return strcmp($a["nombre"], $b["nombre"]);
    }

    // Función para ordenar agentes de Z a A
    function ordenarArmasZA($a, $b) {
        return strcmp($b["nombre"], $a["nombre"]);
    }

   // Aplicar filtros si se han enviado datos desde el formulario
   if (isset($_GET['search'])) {
    $nombreBuscado = $_GET['search'];
    $weapons = filtrarArmasPorNombre($weapons, $nombreBuscado);
}

    if (isset($_GET['category'])) {
      $rolFiltrado = $_GET['category'];
      if ($rolFiltrado !== "") {
          $weapons = filtrarArmasPorCategoria($weapons, $rolFiltrado);
      }
  }

    if (isset($_GET['sort'])) {
        $sortType = $_GET['sort'];
        switch ($sortType) {
            case 'az':
                usort($weapons, 'ordenarArmasAZ');
                break;
            case 'za':
                usort($weapons, 'ordenarArmasZA');
                break;
            default:
                break;
        }
    }

    $categories = [];
    foreach ($weapons as $weapon) {
        $categories[$weapon['category']][] = $weapon;
    }
    foreach ($categories as $category => $weapons) {
      echo "<div class='category-title'><span>" . strtoupper($category) . "</span></div>";
      echo "<div class='weapon-category'>";
      foreach ($weapons as $weapon) {
        
          echo "<div class='weapon-card' onclick=\"window.location='weapons.php?uuid={$weapon['uuid']}'\">";
          echo "<img src='{$weapon['newImage']}' class='weapon-image' alt='{$weapon['nombre']}'>";
          echo "<div class='weapon-name'>{$weapon['nombre']}</div>";
          echo "</div>";
      }
    echo "</div>";
  }
  ?>
</div>
</div>
</body>
</html>
