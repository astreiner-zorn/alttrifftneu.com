<div class="mobile">
<nav class="navbar navbar-dark bg-danger sticky-top">
  <div class="container-fluid">
    <button class="btn btn-danger border border-light d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMobile" aria-controls="sidebarMobile">☰</button>
  </div>
</nav>
</div>

<aside class="d-none d-lg-block bg-danger text-white position-fixed top-0 start-0 h-100 p-3" style="width: var(--sidebar-width); padding-top: 72px;">
    <nav class="nav flex-column gap-2">
        <a href="index.php" class="d-block fs-5 fw-bold text-white text-decoration-none py-2 navlink-hover">Startseite</a>
        <a href="add.php" class="d-block fs-5 fw-bold text-white text-decoration-none py-2 navlink-hover">Eintrag verfassen</a>
    </nav>
</aside>

<!-- Mobile Sidebar (Offcanvas) -->
<div class="offcanvas offcanvas-start text-bg-danger d-lg-none"
     tabindex="-1"
     id="sidebarMobile"
     aria-labelledby="sidebarMobileLabel"
     style="width: var(--sidebar-width);">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title fw-bold" id="sidebarMobileLabel">Menü</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body">
    <nav class="nav flex-column gap-2">
      <a class="nav-link text-white fw-bold" href="index.php">Startseite</a>
      <a class="nav-link text-white fw-bold" href="add.php">Eintrag verfassen</a>
    </nav>
  </div>
</div>
