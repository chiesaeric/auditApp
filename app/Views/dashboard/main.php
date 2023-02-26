<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <section class="content">
    <div class="container-fluid">
      <h2 class="text-center display-4">Search Check Point</h2>
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <form method="POST" action="/" onsubmit="search()">
            <div class="input-group">
              <input type="search" id="searchInput" class="form-control form-control-lg" placeholder="Type your keywords here">
              <div class="input-group-append">
                <button type="submit" id="sebuttonrch" class="btn btn-lg btn-default">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row" style="margin-top: 20px;">
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box shadow-lg">
            <span class="info-box-icon bg-info"><i class="fa fa-book"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Unsuccess Task</span>
              <span class="info-box-number"><?= $unsuccess; ?> Task</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box shadow-lg">
            <span class="info-box-icon bg-success"><i class="fa fa-check"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Success Task</span>
              <span class="info-box-number"><?= $success; ?> Task</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box shadow-lg">
            <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Need Review</span>
              <span class="info-box-number"><?= $inreview; ?> Task</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box shadow-lg">
            <span class="info-box-icon bg-danger"><i class="fa fa-search"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Findings</span>
              <span class="info-box-number"><?= $findings; ?> findings</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <div class="row" id="resultSearch">
      </div>
    </div>
</div>
</div>
</section>
</div>
<?= $this->endSection(); ?>