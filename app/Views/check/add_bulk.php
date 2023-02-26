<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Tambah Bulk Check Point</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/check">Check Point</a></li>
            <li class="breadcrumb-item active">Bulk Check Point</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->

      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-3">
                  <div class="form-group">
                    <select name="" id="id-tipe-bulk" class="form-control" required>
                      <option value="#" selected disabled>--Pilih Tipe--</option>
                      <option value="system">System</option>
                      <option value="proses">Proses</option>
                      <option value="verification">Verification</option>
                    </select>
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-group">
                    <select name="" id="id-category-bulk" class="form-control select2bs4" required>
                      <option value="#" selected disabled>--Pilih Category--</option>
                    </select>
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-group">
                    <select name="" id="id-area-bulk" class="form-control select2bs4" required>
                      <option value="#" selected disabled>--Pilih Area--</option>
                    </select>
                  </div>
                </div>
                <div class="col-2">
                  <input type="number" name="" id="number-bulk" class="form-control" placeholder="Jumlah" required>
                </div>
                <div class="col-1">
                  <button class="btn btn-success" id="btn-add-bulk"><i class="fa fa-plus"></i></button>
                </div>
                <div class="col-2">
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">



              <form name="FormBulk" action="/check/saveMultiBulk" method="post">
                <?php csrf_field(); ?>
                <div class="card card-success card-outline">
                  <div class="card-header">
                    <h3 class="card-title">
                      <b>Total Check Point</b>
                      (<b id="number-count-bulk-show">0</b>)
                    </h3>
                    <input type="hidden" name="count" id="number-count-bulk" value="0">
                    <button type="submit" class="btn btn-success float-right" id="submit-bulk">Tambah Semua</button>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-5 col-sm-3">
                        <div class="nav flex-column nav-tabs h-100 side-bulk-cp" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                        </div>
                      </div>
                      <div class="col-7 col-sm-9">
                        <div class="tab-content main-bulk-cp" id="vert-tabs-tabContent">
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card -->
                </div>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<?= $this->endSection(); ?>