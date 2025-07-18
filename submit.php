<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo   = $_POST['tipo']   ?? '';
    $tiempo = isset($_POST['tiempo']) ? (int)$_POST['tiempo'] : -1;
    $estado = $_POST['estado'] ?? '';

    if (
        in_array($tipo, ['entry', 'exit'], true) &&
        $tiempo >= 0 && $tiempo <= 300 &&
        in_array($estado, ['fluido', 'moderado', 'lento', 'cerrado'], true)
    ) {
        insertReport($tipo, $tiempo, $estado);
    }
}

header('Location: index.php');
exit;