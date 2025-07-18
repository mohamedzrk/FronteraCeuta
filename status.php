<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

if (isset($_GET['format']) && $_GET['format'] === 'json') {
    header('Content-Type: application/json; charset=utf-8');
    $points = [
        ['tipo' => 'entry', 'lat' => 35.888, 'lng' => -5.316],
        ['tipo' => 'exit',  'lat' => 35.889, 'lng' => -5.315],
    ];
    $data = [];
    foreach ($points as $p) {
        $st = getLatestStatus($p['tipo']);
        $data[] = array_merge($p, [
            'tiempo' => (int)$st['tiempo'],
            'estado' => $st['estado'],
        ]);
    }
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}

$all = getAllReports();
include __DIR__ . '/includes/header.php';
?>

<main class="container">
  <section class="card">
    <h2>Histórico de reportes</h2>
    <?php if (!$all): ?>
      <p>No hay reportes todavía.</p>
    <?php else: ?>
      <ul class="reports-list">
        <?php foreach ($all as $r): ?>
          <li>
            <span class="label"><?= $r['tipo'] === 'entry' ? 'Entrada' : 'Salida' ?></span>
            <span class="time"><?= $r['tiempo'] ?> min</span>
            <span class="state"><?= htmlspecialchars($r['estado']) ?></span>
            <small class="date"><?= htmlspecialchars($r['created_at']) ?></small>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </section>
</main>

<?php include __DIR__ . '/includes/footer.php'; ?>