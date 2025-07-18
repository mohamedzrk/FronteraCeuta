<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

$entry = getLatestStatus('entry');
$exit  = getLatestStatus('exit');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo   = $_POST['tipo'] ?? '';
    $tiempo = isset($_POST['tiempo']) ? (int)$_POST['tiempo'] : -1;
    $estado = $_POST['estado'] ?? '';
    $comentario = trim($_POST['comentario'] ?? '');

    if (
        in_array($tipo, ['entry', 'exit'], true) &&
        $tiempo >= 0 && $tiempo <= 300 &&
        in_array($estado, ['fluido', 'moderado', 'lento', 'cerrado'], true)
    ) {
        insertReport($tipo, $tiempo, $estado, $comentario);
        header('Location: index.php');
        exit;
    }
    $error = 'Error al guardar tu reporte.';
}

include __DIR__ . '/includes/header.php';
?>

<main class="main-content">

  <!-- Hero -->
  <section class="hero">
    <img src="assets/frontera_ceuta.png" alt="Frontera de Ceuta" class="hero-img" loading="lazy">
    <div class="hero-overlay">
      <h1 class="hero-title">CeutaStatus</h1>
      <p class="hero-subtitle">Tiempos de espera en tiempo real</p>
    </div>
  </section>

  <!-- Estado Actual -->
  <section class="status-now">
    <div class="container">
      <h2 class="section-title">Estado Actual</h2>
      <div class="status-grid">
        <div class="status-card">
          <h3>Entrada</h3>
          <p class="time"><?= is_numeric($entry['tiempo']) ? $entry['tiempo'] : '—' ?> min</p>
          <p class="state"><?= htmlspecialchars($entry['estado']) ?></p>
          <small><?= timeAgo($entry['created_at']) ?></small>
          <?php if (!empty($entry['comentario'])): ?>
            <p class="comment"><strong>Nota:</strong> <?= htmlspecialchars($entry['comentario']) ?></p>
          <?php endif; ?>
        </div>

        <div class="status-card">
          <h3>Salida</h3>
          <p class="time"><?= is_numeric($exit['tiempo']) ? $exit['tiempo'] : '—' ?> min</p>
          <p class="state"><?= htmlspecialchars($exit['estado']) ?></p>
          <small><?= timeAgo($exit['created_at']) ?></small>
          <?php if (!empty($exit['comentario'])): ?>
            <p class="comment"><strong>Nota:</strong> <?= htmlspecialchars($exit['comentario']) ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- Mensaje animador + Formulario -->
  <section class="form-section" id="report-form">
    <div class="container">
      <div class="call-to-action">
        <h2>¡Colabora con la comunidad!</h2>
        <p>Contanos cómo va la cola en la frontera y entre <strong>todos</strong> ayudaremos a miles de viajeros.<br>
        Tu reporte tarda solo <strong>10 segundos</strong> y es <strong>muy valioso</strong>.</p>
      </div>

      <br>

      <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>

      <form method="post" action="index.php" class="form-card">
        <label for="tipo">Tipo</label>
        <select id="tipo" name="tipo" required>
          <option value="entry">Entrada</option>
          <option value="exit">Salida</option>
        </select>

        <label for="tiempo">Tiempo (min)</label>
        <input type="number" id="tiempo" name="tiempo" min="0" max="300" required>

        <label for="estado">Estado</label>
        <select id="estado" name="estado" required>
          <option value="fluido">Fluido</option>
          <option value="moderado">Moderado</option>
          <option value="lento">Lento</option>
          <option value="cerrado">Cerrado</option>
        </select>

        <label for="comentario">Comentario (opcional)</label>
        <textarea id="comentario" name="comentario" maxlength="255" placeholder="Ej: Muchas colas en el carril de coches"></textarea>

        <button type="submit" class="btn-primary">Enviar reporte</button>
      </form>
    </div>
  </section>

</main>

<?php include __DIR__ . '/includes/footer.php'; ?>