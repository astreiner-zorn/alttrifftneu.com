<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/layout/header.php");
    $pageTitle = "Alle Blog-Einträge";
?>

<div class="p-2 mt-5 mb-5">
    <h1 class="h1 text-danger"><span class="fw-bold"><?= $pageTitle; ?></span></h1>
    <hr class="border border-5 border-danger opacity-100 w-5 rounded" style="width:50px;">
</div>

<?php
  $sql = "SELECT id, headline, content, created_at FROM blog ORDER BY id DESC";
  $statement = $pdo->query($sql);
  $artikel = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<table class="table table-striped bordered">
    <thead>
        <tr>
            <th class="p-5">ID</th>
            <th class="p-5">Titel</th>
            <th class="p-5">Datum</th>
            <th class="p-5">Aktion</th>
        </tr>
    </thead>
    <tbody>
      <?php foreach ($artikel as $eintrag): ?>
      <tr>
        <td class="p-5"><?= htmlspecialchars($eintrag['id']) ?></td>
        <td class="p-5"><a href="article.php?&id=<?= urlencode($eintrag['id']) ?>" class="d-block fs-6 fw-bold text-decoration-none py-2 text-hover-success" target="_blank"><?= htmlspecialchars($eintrag['headline']) ?></a></td>

        <td class="p-5"><?= date('d.m.Y', strtotime($eintrag['created_at'])) ?>, <?= date('H:i', strtotime($eintrag['created_at'])) ?> Uhr</td>
        <td class="p-5">
        <p class="mb-0"><a href="edit.php?&id=<?= urlencode($eintrag['id']) ?>" class="d-block fs-6 fw-bold text-decoration-none py-2 text-hover-success">Bearbeiten</a></p>
        <p><a href="delete.php?&id=<?= urlencode($eintrag['id']) ?>" class="d-block fs-6 fw-bold text-decoration-none py-2 text-hover-success">Löschen</a></p>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/layout/footer.php"); ?>