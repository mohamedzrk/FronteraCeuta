<?php
require_once __DIR__ . '/includes/functions.php';

// Traemos últimos estados
$entry = getLatestStatus('entry');
$exit  = getLatestStatus('exit');

// Si viene POST de formulario, lo procesamos aquí
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $tipo   = $_POST['tipo'];    // 'entry' o 'exit'
  $tiempo = (int)$_POST['tiempo'];
  $estado = $_POST['estado'];  // 'fluido', 'moderado', etc.
  if (insertReport($tipo, $tiempo, $estado)) {
    // Recarga para ver el nuevo estado
    header('Location: index.php');
    exit;
  } else {
    $error = 'Error al guardar tu reporte, inténtalo de nuevo.';
  }
}

include __DIR__ . '/includes/header.php';
?>

<!-- Hero + Mapa -->
<section class="hero-map">
  <div id="map" style="width:100%;height:60vh;"></div>
  <div class="status-overlays">
    <div class="status-card entry">
      <span class="material-icons">login</span>
      <div>
        <h4>Entrada</h4>
        <p><span id="wait-entry"><?= htmlspecialchars($entry['tiempo']) ?></span> min</p>
        <small><?= htmlspecialchars($entry['estado']) ?></small>
      </div>
    </div>
    <div class="status-card exit">
      <span class="material-icons">logout</span>
      <div>
        <h4>Salida</h4>
        <p><span id="wait-exit"><?= htmlspecialchars($exit['tiempo']) ?></span> min</p>
        <small><?= htmlspecialchars($exit['estado']) ?></small>
      </div>
    </div>
  </div>
</section>

<!-- Formulario de reporte -->
<section id="report-form" class="container card">
  <h2>Reporta el estado ahora</h2>
  <?php if (!empty($error)): ?>
    <p class="error"><?= $error ?></p>
  <?php endif; ?>
  <form method="post" action="index.php" class="form-card">
    <label for="tipo">Tipo:</label>
    <select id="tipo" name="tipo" required>
      <option value="entry">Entrada</option>
      <option value="exit">Salida</option>
    </select>

    <label for="tiempo">Tiempo (minutos):</label>
    <input type="number" id="tiempo" name="tiempo" min="0" required>

    <label for="estado">Estado:</label>
    <select id="estado" name="estado" required>
      <option value="fluido">Fluido</option>
      <option value="moderado">Moderado</option>
      <option value="lento">Lento</option>
      <option value="cerrado">Cerrado</option>
    </select>

    <button type="submit" class="btn btn-primary">Enviar Reporte</button>
  </form>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
