<?php
require_once __DIR__ . '/includes/functions.php';

// Últimos estados
$entry = getLatestStatus('entry');
$exit  = getLatestStatus('exit');

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $tipo   = $_POST['tipo'];
  $tiempo = (int)$_POST['tiempo'];
  $estado = $_POST['estado'];
  if (insertReport($tipo, $tiempo, $estado)) {
    header('Location: index.php');
    exit;
  } else {
    $error = 'Error al guardar tu reporte.';
  }
}

// Cálculo de datos
if (is_numeric($entry['tiempo']) && is_numeric($exit['tiempo'])) {
  $avgWait = round(($entry['tiempo'] + $exit['tiempo']) / 2);
  $advice  = $avgWait <= 15 ? 'Cruza ahora' : 'Mejor espera';
} else {
  $avgWait = '—';
  $advice  = 'Sin datos';
}

include __DIR__ . '/includes/header.php';
?>

<!-- Hero + Imagen -->
<section class="hero-image">
  <img src="assets/frontera_ceuta.jpg" alt="Imagen frontal frontera Ceuta" class="hero-img">
  <div class="status-overlays">
    <!-- Entrada -->
    <div class="status-card entry">
      <span class="material-icons">login</span>
      <div>
        <h4>Entrada</h4>
        <p><span><?= htmlspecialchars($entry['tiempo']) ?></span> min</p>
        <small><?= htmlspecialchars($entry['estado']) ?></small>
      </div>
    </div>
    <!-- Salida -->
    <div class="status-card exit">
      <span class="material-icons">logout</span>
      <div>
        <h4>Salida</h4>
        <p><span><?= htmlspecialchars($exit['tiempo']) ?></span> min</p>
        <small><?= htmlspecialchars($exit['estado']) ?></small>
      </div>
    </div>
  </div>
</section>

<!-- Información relevante -->
<section class="info-cards container">
  <div class="info-card">
    <h4>Entrada</h4>
    <p class="info-number"><?= htmlspecialchars($entry['tiempo']) ?> <small>min</small></p>
    <small class="info-meta">Última: <?= htmlspecialchars($entry['created_at']) ?></small>
    <small class="state"><?= htmlspecialchars($entry['estado']) ?></small>
  </div>
  <div class="info-card">
    <h4>Salida</h4>
    <p class="info-number"><?= htmlspecialchars($exit['tiempo']) ?> <small>min</small></p>
    <small class="info-meta">Última: <?= htmlspecialchars($exit['created_at']) ?></small>
    <small class="state"><?= htmlspecialchars($exit['estado']) ?></small>
  </div>
  <div class="info-card">
    <h4>Espera Media</h4>
    <p class="info-number"><?= is_numeric($avgWait) ? $avgWait : '—' ?> <small>min</small></p>
  </div>
  <div class="info-card">
    <h4>Recomendación</h4>
    <p class="advice"><?= htmlspecialchars($advice) ?></p>
  </div>
</section>

<!-- Formulario -->
<section id="report-form" class="container card">
  <h2>Reporta ahora</h2>
  <?php if (!empty($error)): ?>
    <p class="error"><?= $error ?></p>
  <?php endif; ?>
  <form method="post" action="index.php" class="form-card">
    <label for="tipo">Tipo:</label>
    <select id="tipo" name="tipo">
      <option value="entry">Entrada</option>
      <option value
