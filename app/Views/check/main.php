<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Check Point</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">Check Point</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->

      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <button class="btn btn-success" data-toggle="modal" data-target="#modal-add-cp-ms">Tambah Check Point</button>
              <a href="check/bulk" class="btn btn-success">Tambah Bulk Check Point</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Tipe</th>
                    <th>Category</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($check as $c) : ?>
                    <tr style="text-align:center; vertical-align:middle">
                      <td><?= $no++; ?></td>
                      <td style="text-align: left;">
                        <b>Title: </b><?= mb_strimwidth($c['title_cp'], 0, 45, " ..."); ?><br>
                        <b>Clausal: </b><?= ($c['clausal'] == null ? "-" : $c['clausal']); ?>
                      </td>
                      <td><?= $c['tipe']; ?></td>
                      <td><?= $c['title']; ?></td>
                      <td>
                        <a href="#" class="btn btn-info btn-sm btn-edit-cp-ms" data-id="<?= $c['id_cp']; ?>" data-name="<?= $c['title_cp']; ?>" data-clausal="<?= $c['clausal']; ?>" data-evidence="<?= $c['evidence']; ?>" data-description="<?= $c['description']; ?>" data-area="<?= $c['id_area']; ?>"><i class="fa fa-edit"></i></a>
                        <?php if (!isset($arrDetail[$c['id_cp']])) : ?>
                          &NonBreakingSpace;|&NonBreakingSpace;
                          <a href="#" class="btn btn-danger btn-sm btn-hapus-cp-ms" data-id="<?= $c['id_cp']; ?>"><i class="fa fa-trash"></i></a>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Tipe</th>
                    <th>Category</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div><!-- /.col -->
      </div><!-- /.row -->
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


<!-- modal -->
<div class="modal fade" id="modal-add-cp-ms">
  <div class=" modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Check Point</h4>
      </div>
      <form action="/check/save" method="post">
        <?php csrf_field(); ?>
        <div class="modal-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Tipe</label>
                <select name="tipe" id="choose-tipe-cp-ms" class="form-control" required>
                  <option value="#" selected>--Pilih Tipe Check Point--</option>
                  <option value="system">System</option>
                  <option value="proses">Proses</option>
                  <option value="verification">Verification</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Pilih Area</label>
                <select name="id_area" id="id-area-cp" class="form-control select2bs4">
                  <option value="#" selected>--Pilih Area--</option>
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Category</label>
                <select name="id_category" id="id-category-cp" class="form-control select2bs4" required>
                  <option value="#" selected>--Pilih Category--</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">Clausal <b id="toptitle"></b></label>
                <input type="text" name="clausal" id="clausal-cp-ms" class="form-control" minlength="2" placeholder="Clausal">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title_cp" id="" class="form-control" minlength="8" required>
              </div>
              <div class="form-group">
                <label for="">Evidence</label>
                <input type="text" name="evidence" id="" class="form-control" minlength="8" required>
              </div>
              <div class="form-group">
                <label for="">Keterangan</label>
                <textarea name="description" class="form-control" id="" cols="20" rows="10"></textarea>
              </div>
            </div>
          </div>

          <div class="modal-footer justify-content-between">
            <input type="hidden" name="uri" id="" value="<?= uri_string(); ?>">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- modal -->
<div class="modal fade" id="editModal-cp-ms">
  <div class=" modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ubah Check Point</h4>
      </div>
      <form action="/check/update" method="post">
        <?php csrf_field(); ?>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="">Clausal <b id="toptitle"></b></label>
                <input type="text" name="clausal" id="" class="form-control clausal-cp-ms" minlength="2" placeholder="Clausal">
              </div>
              <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title_cp" id="" class="form-control title-cp-ms" minlength="8" required>
              </div>
              <div class="form-group">
                <label for="">Evidence</label>
                <input type="text" name="evidence" id="" class="form-control evidence-cp-ms" minlength="8" required>
              </div>
              <div class="form-group">
                <label for="">Keterangan</label>
                <textarea name="description" class="form-control description-cp-ms" id="" cols="20" rows="10"></textarea>
              </div>
            </div>
          </div>

          <div class="modal-footer justify-content-between">
            <input type="hidden" name="id_cp" id="" class="id-cp-ms">
            <input type="hidden" name="id_area" id="" class="id-area-cp-ms">
            <input type="hidden" name="uri" id="" value="<?= uri_string(); ?>">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- modal Hapus -->
<div class="modal fade" id="deleteModal-cp-ms">
  <div class=" modal-dialog">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Check Point</h4>
      </div>
      <div class="modal-body">
        Apa anda yakin ingin menghapus Check Point ini?
      </div>
      <form action="/check/delete" method="post">
        <?php csrf_field(); ?>
        <div class="modal-footer justify-content-between">
          <input type="hidden" name="id_cp" class="id">
          <input type="hidden" name="uri" id="" value="<?= uri_string(); ?>">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-outline-light">Hapus</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= $this->endSection(); ?>