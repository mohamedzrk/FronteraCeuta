<?php
declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Tiempo real de espera en la frontera de Ceuta">
  <title>CeutaStatus</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css?v=2">
</head>
<body id="top">

<header class="header-modern">
  <div class="container header-inner">
    <a href="index.php" class="logo">
      <span class="material-icons">map</span>
      CeutaStatus
    </a>

    <input type="checkbox" id="nav-toggle" class="nav-toggle">
    <label for="nav-toggle" class="nav-toggle-label">
      <span class="hamburger"></span>
    </label>

    <nav class="nav-modern">
      <ul class="nav-list">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="index.php#report-form">Reportar</a></li>
        <li><a href="status.php">Histórico</a></li>
        <li><a href="about.php">Acerca</a></li>
      </ul>
    </nav>
  </div>
</header>