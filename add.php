<?php
  require_once($_SERVER['DOCUMENT_ROOT'] . "/layout/header.php");
  $pageTitle = "Blog-Eintrag erstellen";
?>

<div class="p-2 mt-5 mb-5">
    <h1 class="h1 text-danger"><span class="fw-bold"><?= $pageTitle; ?></span></h1>
    <hr class="border border-5 border-danger opacity-100 w-5 rounded" style="width:50px;">
</div>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $headline   = trim($_POST['headline'] ?? '');
        $content    = trim($_POST['content'] ?? '');
        $created_at = $_POST['created_at'] ?? '';
        $created_at = str_replace('T', ' ', $created_at);
        if (strlen($created_at) === 16) $created_at .= ':00';
        $statement = $pdo->prepare(
            'INSERT INTO blog (headline, content, created_at) VALUES (:headline, :content, :created_at)'
        );

        $ok = $statement->execute([
            ':headline' => $headline,
            ':content'  => $content,
            ':created_at' => $created_at
        ]);

        if (!$ok) {
            echo "<div class='alert alert-danger'>Fehler beim Speichern.</div>";
        } else {
            header("Location: index.php");
            exit;
        }   
    }
?>

<form method="POST" class="d-grid space-y-4" id="blogForm">
  <div class="mb-3">
    <label for="headline" class="form-label">Titel</label>
    <input type="text" class="form-control" id="headline" name="headline" placeholder="Bitte leg den Titel fest" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Inhalt</label>
    <input type="hidden" name="content" id="content">
    <div id="editor" class="border rounded p-2 bg-white"></div>
  </div>

  <div class="mb-3">
    <label for="created_at" class="form-label">Veröffentlichung</label>
    <input type="datetime-local" class="form-control" id="created_at" name="created_at" required>
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
  document.getElementById('blogForm')?.addEventListener('submit', function () {
    document.getElementById('content').value = window.editor.getData();
  });
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/layout/footer.php"); ?>