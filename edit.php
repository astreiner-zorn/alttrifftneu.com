<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/layout/header.php");
$pageTitle = "Blog-Eintrag bearbeiten";
?>

<div class="p-2 mt-5 mb-5">
    <h1 class="h1 text-danger"><span class="fw-bold"><?= $pageTitle; ?></span></h1>
    <hr class="border border-5 border-danger opacity-100 w-5 rounded" style="width:50px;">
</div>

<?php
$id = (int) $_GET['id'];

// Datensatz abrufen
$sql = "SELECT * FROM blog WHERE id = ?";
$statement = $pdo->prepare($sql);
$statement->execute([$id]);
$eintrag = $statement->fetch(PDO::FETCH_ASSOC);

if (!$eintrag) {
    echo "<div class='text-red-500'>Eintrag nicht gefunden.</div>";
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $headline = $_POST['headline'] ?? '';
    $content  = $_POST['content'] ?? '';

    $created_at = $_POST['created_at'] ?? '';
    $created_at = str_replace('T', ' ', $created_at);
    if (strlen($created_at) === 16) $created_at .= ':00';

    $updateSql = "UPDATE blog SET headline = ?, content = ?, created_at = ? WHERE id = ?";
    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->execute([$headline, $content, $created_at, $id]);

    header("Location: index.php");
    exit;
}
?>

<form method="POST" class="d-grid space-y-4 mb-3" id="blogForm">
    <div class="mb-3">
        <label for="headline" class="form-label">Titel</label>
        <input type="text" class="form-control" id="headline" name="headline" value="<?= htmlspecialchars($eintrag['headline']) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Inhalt</label>
        <input type="hidden" name="content" id="content">
        <div id="editor" class="border rounded p-2 bg-white">
            <?= $eintrag['content'] ?>
        </div>
    </div>

    <?php
    $createdValue = $eintrag['created_at'] ?? '';
    $createdValue = str_replace(' ', 'T', $createdValue);
    $createdValue = substr($createdValue, 0, 16); // YYYY-MM-DDTHH:MM
    ?>
    <div class="mb-3">
        <label for="created_at" class="form-label">Veröffentlichung</label>
        <input type="datetime-local" class="form-control" id="created_at" name="created_at" required value="<?= htmlspecialchars($createdValue) ?>">
    </div>

    <div class="row mt-3">
        <div class="col-md-auto">
            <button type="submit" class="btn btn-success">Artikel speichern</button>
        </div>
        <div class="col-md-auto">
            <button type="reset" class="btn btn-warning">Zurücksetzen</button>
        </div>
    </div>
</form>

<script>
    document.getElementById('blogForm')?.addEventListener('submit', function() {
        document.getElementById('content').value = window.editor.getData();
    });
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/layout/footer.php"); ?>