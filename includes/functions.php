<?php
// includes/functions.php
require_once __DIR__ . '/db.php';

/**
 * Devuelve el último reporte para entrada/salida
 * @param string $type 'entry' o 'exit'
 */
function getLatestStatus(string $type): array {
  global $pdo;
  $stmt = $pdo->prepare("
    SELECT estado, tiempo, created_at 
    FROM reportes 
    WHERE tipo = :type 
    ORDER BY created_at DESC 
    LIMIT 1
  ");
  $stmt->execute(['type' => $type]);
  return $stmt->fetch() ?: ['estado' => '—', 'tiempo' => '—', 'created_at' => null];
}

/**
 * Inserta un nuevo reporte
 */
function insertReport(string $type, int $tiempo, string $estado): bool {
  global $pdo;
  $stmt = $pdo->prepare("
    INSERT INTO reportes (tipo, tiempo, estado, created_at)
    VALUES (:tipo, :tiempo, :estado, NOW())
  ");
  return $stmt->execute([
    'tipo'   => $type,
    'tiempo' => $tiempo,
    'estado' => $estado
  ]);
}

/**
 * Obtiene todos los reportes (para history)
 */
function getAllReports(): array {
  global $pdo;
  return $pdo
    ->query("SELECT * FROM reportes ORDER BY created_at DESC")
    ->fetchAll();
}
