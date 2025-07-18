<?php
// includes/header.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CeutaStatus</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css?v=2.0">
  <link rel="stylesheet" href="js/leaflet.css">
  <script defer src="js/leaflet.js"></script>
  <script defer src="js/map-init.js"></script>
</head>
<body id="top">
<header class="site-header">
  <div class="container header-inner">
    <a href="index.php" class="logo">CeutaStatus</a>
    <input type="checkbox" id="nav-toggle" class="nav-toggle">
    <label for="nav-toggle" class="nav-toggle-label">
      <span></span>
    </label>
    <nav class="nav">
      <ul class="nav-list">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="index.php#report-form">Reportar</a></li>
        <li><a href="status.php">Histórico</a></li>
        <li><a href="about.php">Acerca</a></li>
      </ul>
    </nav>
  </div>
</header>

