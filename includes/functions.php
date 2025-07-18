<?php
declare(strict_types=1);
require_once __DIR__ . '/db.php';

function timeAgo(?string $date): string {
    if (!$date) return 'nunca';
    $diff = time() - strtotime($date);

    if ($diff < 60)      return 'hace ' . $diff . ' seg';
    if ($diff < 3600)    return 'hace ' . round($diff / 60) . ' min';
    if ($diff < 86400)   return 'hace ' . round($diff / 3600) . ' h';
    return 'hace ' . round($diff / 86400) . ' d';
}

function getLatestStatus(string $type): array {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT estado, tiempo, created_at, comentario
        FROM reportes
        WHERE tipo = :type
        ORDER BY created_at DESC
        LIMIT 1
    ");
    $stmt->execute(['type' => $type]);
    return $stmt->fetch() ?: ['estado' => '—', 'tiempo' => '—', 'created_at' => null, 'comentario' => ''];
}

function insertReport(string $type, int $tiempo, string $estado, string $comentario = ''): bool {
    global $pdo;
    $stmt = $pdo->prepare("
        INSERT INTO reportes (tipo, tiempo, estado, comentario, created_at)
        VALUES (:tipo, :tiempo, :estado, :comentario, NOW())
    ");
    return $stmt->execute([
        'tipo'       => $type,
        'tiempo'     => $tiempo,
        'estado'     => $estado,
        'comentario' => $comentario,
    ]);
}

function getAllReports(): array {
    global $pdo;
    return $pdo->query("SELECT * FROM reportes ORDER BY created_at DESC")->fetchAll();
}