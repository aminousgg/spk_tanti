  <?php 
    $username = $this->session->userdata('sesi_admin')['username'];

   ?>


  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('assets_lte') ?>/index3.html" class="brand-link">
      <img src="<?= base_url('assets_lte') ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SPK Tanti</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets_lte') ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block mb-0"><?= $username ?></a><br><a href="#" class="d-block">[ADMIN]</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2 ininav">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item">
                    <a href="<?= base_url('admin/pelamar') ?>" class="nav-link <?php if($side_row == 1){ echo "active"; } ?>">
                      <i class="nav-icon fas fa-th"></i>
                      <p>Pelamar</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('admin/spk') ?>" class="nav-link <?php if($side_row == 2){ echo "active"; } ?>">
                      <i class="nav-icon fas fa-th"></i>
                      <p>Analisis</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link <?php if($side_row == 3){ echo "active"; } ?>">
                      <i class="nav-icon fas fa-th"></i>
                      <p>Perhitungan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-th"></i>
                      <p>List Apply</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-th"></i>
                      <p>Ubah Password</p>
                    </a>
                  </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>