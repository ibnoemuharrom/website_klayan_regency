<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
  <div class="position-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link text-white" aria-current="page" href="dashboard.php">
          <i class="bi bi-house"></i>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="product.php">
          <i class="bi bi-box"></i>
          Produk
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="pembeli.php">
          <i class="bi bi-people-fill"></i>
          Pembeli
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="data_rumah.php">
          <i class="bi bi-house-fill"></i>
          Data Rumah
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="type_rumah.php">
          <i class="bi bi-house"></i>
          Type Rumah
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="input_brosur.php">
          <i class="bi bi-file-image"></i>
          Brosur
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="input_pricelist.php">
          <i class="bi bi-file-earmark-richtext"></i>
          Daftar Harga
        </a>
      </li>
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-1 mb-1 text-white-100">
      <span>HALAMAN</span>
    </h6>
    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link text-white" href="page_header.php">
          <i class="bi bi-file-earmark"></i>
          Header
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="page_about.php">
          <i class="bi bi-file-earmark"></i>
          About
        </a>
      </li>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-1 mb-1 text-white-100">
      <span>PENGATURAN</span>
    </h6>
    <li class="nav-item">
        <a class="nav-link text-white" href="kontak.php">
          <i class="bi bi-chat-left-text"></i>
          Kontak
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="edit_user.php?id=<?= $_SESSION['user']['id']; ?>">
          <i class="bi bi-person"></i>
          Data user
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="logout.php">
          <i class="bi bi-box-arrow-left"></i>
          Logout
        </a>
      </li>
    </ul>
  </div>
</nav>