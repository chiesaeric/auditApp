<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/" class="brand-link">
    <img src="<?= base_url() ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AuditApp</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block"><?= session()->get('nama'); ?> <b>(<?= session()->get('tipe'); ?>)</b></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Task
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/task" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Task</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/taskboard" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Task Board</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/taskSummary" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Task Summary</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Category
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/category" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/check" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Check Point</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="/finding" class="nav-link">
            <i class="nav-icon fas fa-search"></i>
            <p>Findings</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/users" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Users</p>
          </a>
        </li>


      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>