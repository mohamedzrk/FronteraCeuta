<?php
// includes/header.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>CeutaStatus</title>
  <link rel="stylesheet" href="css/styles.css">
  <!-- Leaflet -->
  <link rel="stylesheet" href="js/leaflet.css"/>
  <script src="js/leaflet.js"></script>
</head>
<body id="top">
<header class="site-header">
  <div class="container header-inner">
    <a href="index.php" class="logo">
      <img src="assets/logo.svg" alt="CeutaStatus logo" width="32" height="32">
      CeutaStatus
    </a>
    <button class="btn-nav-toggle" aria-label="Abrir menú">☰</button>
    <nav class="nav">
      <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="index.php#report-form">Reportar</a></li>
        <li><a href="status.php">Histórico</a></li>
        <li><a href="about.php">Acerca</a></li>
      </ul>
    </nav>
  </div>
</header>
