<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/layout/header.php"); ?>

<?php
// ID lesen und validieren
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    http_response_code(400);
    echo "<div class='alert alert-danger mt-3'>Ungültige Artikel-ID.</div>";
    require_once($_SERVER['DOCUMENT_ROOT'] . "/layout/footer.php");
    exit;
}

// Artikel laden
$stmt = $pdo->prepare("SELECT id, headline, content, created_at FROM blog WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    http_response_code(404);
    echo "<div class='alert alert-warning mt-3'>Artikel nicht gefunden.</div>";
    require_once($_SERVER['DOCUMENT_ROOT'] . "/layout/footer.php");
    exit;
}

$createdAt = $article['created_at'] ?? '';
?>


<div class="p-3 mt-5 mb-5">
<h1 class="h1 text-danger fw-bolder mb-2"><?= htmlspecialchars($article['headline']) ?></h1>
<hr class="border border-5 border-danger opacity-100 w-5 rounded" style="width:50px;">

  
<?php if ($createdAt): ?>
<div class="text-muted small mt-5 mb-4">Veröffentlicht: <?= htmlspecialchars($createdAt) ?></div>
<?php endif; ?>

<article>
  <?= $article['content'] ?>
</article>

<div class="d-flex justify-content-end mt-5 mr-5">
  <a class="btn btn-danger fw-bold" href="edit.php?id=<?= (int)$article['id'] ?>">Bearbeiten</a>
</div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/layout/footer.php"); ?>