<?php
// status.php
require_once __DIR__ . '/includes/functions.php';

if (isset($_GET['format']) && $_GET['format'] === 'json') {
  header('Content-Type: application/json; charset=utf-8');
  $points = [
    ['tipo'=>'entry','lat'=>35.888,'lng'=>-5.316],
    ['tipo'=>'exit','lat'=>35.889,'lng'=>-5.315],
  ];
  $data = [];
  foreach ($points as $p) {
    $st = getLatestStatus($p['tipo']);
    $data[] = array_merge($p, [
      'tiempo'=>(int)$st['tiempo'],
      'estado'=>$st['estado']
    ]);
  }
  echo json_encode($data);
  exit;
}

$all = getAllReports();
include __DIR__ . '/includes/header.php';
?>
<main class="container">
  <section class="card">
    <h2>Histórico de Reportes</h2>
    <ul class="reports-list">
      <?php foreach ($all as $r): ?>
        <li>
          <span><?= $r['tipo']==='entry'?'Entrada':'Salida' ?></span>
          <span><?= htmlspecialchars($r['tiempo']) ?> min</span>
          <span><?= htmlspecialchars($r['estado']) ?></span>
          <small><?= htmlspecialchars($r['created_at']) ?></small>
        </li>
      <?php endforeach; ?>
    </ul>
  </section>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
