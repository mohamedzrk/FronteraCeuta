<?php
// submit.php
require_once __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo   = $_POST['tipo'] ?? '';
    $tiempo = isset($_POST['tiempo']) ? (int)$_POST['tiempo'] : 0;
    $estado = $_POST['estado'] ?? '';

    if (in_array($tipo, ['entry','exit'], true)
      && $tiempo >= 0
      && in_array($estado, ['fluido','moderado','lento','cerrado'], true)) {

      if (insertReport($tipo, $tiempo, $estado)) {
        header('Location: index.php');
        exit;
      }
    }
}
// En caso de error, vuelve a la página principal con parámetro
header('Location: index.php?error=1');
