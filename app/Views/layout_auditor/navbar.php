  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="/" class="navbar-brand">
        <img src="<?= base_url(); ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= session()->get('nama'); ?> (<b><?= session()->get('tipe'); ?></b>)</span>
      </a>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
          <a href="/" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="/task/auditor" class="nav-link">Task
            <?php if (session()->get('totalTask')) : ?>
              <span class="badge badge-danger"><?= session()->get('totalTask'); ?></span>
            <?php endif; ?>
          </a>

        </li>
        <li class="nav-item">
          <a class="nav-link" href="/logout">
            logout
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->