<?php
declare(strict_types=1);

// ---- CORS ----
$allowedOrigins = [
  'http://localhost:5173',
  'https://riftcore.de',
  'https://acp.riftcore.de',
];

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if ($origin && in_array($origin, $allowedOrigins, true)) {
  header("Access-Control-Allow-Origin: $origin");
  header('Vary: Origin');
}

header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Preflight should return NO body
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'OPTIONS') {
  http_response_code(204);
  exit;
}

// ---- JSON output ----
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../_inc/db.php';

try {
  $pdo = db();

  $stmt = $pdo->query("
    SELECT ID, headline, content, created_at, changed_at
    FROM blog
    ORDER BY created_at DESC
    LIMIT 50
  ");

  echo json_encode([
    'ok' => true,
    'items' => $stmt->fetchAll(),
  ], JSON_UNESCAPED_UNICODE);

} catch (Throwable $e) {
  http_response_code(500);
  echo json_encode(['ok' => false, 'error' => 'Server error'], JSON_UNESCAPED_UNICODE);
}