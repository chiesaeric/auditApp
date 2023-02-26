<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Detail Category</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/category">Category</a></li>
            <li class="breadcrumb-item active">Detail Category System</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col">
                  <h3 class="m-0"><?= $category['title']; ?></h4>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  Tipe : Audit <?= $category['type']; ?>
                </div>
                <div class="col-6" style="text-align: right;">
                  Created At : <?= date('d M Y', strtotime($category['created_at'])); ?>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <section class="content">
              <div class="card-body">
                <div class="row">
                  <div class="col-8">
                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-add-cp">Add Check Point</a>
                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-add-cp-exist">Add Check Point from Existing</a>
                    <a href="/check/bulk" class="btn  btn-sm btn-success">Tambah Bulk Check Point</a>
                  </div>
                  <div class="col-4" style="text-align: right;"><b>Total Check Point (<?= $cpCount; ?>)</b></div>
                </div>
            </section>


            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12">
                    <?php $num = 1; ?>
                    <?php foreach ($cp as $c) : ?>
                      <!-- Default box -->
                      <div class="card collapsed-card card-info">
                        <div class="card-header" data-card-widget="collapse" title="Collapse">
                          <h3 class="card-title"><b><?= $num++; ?>. <?= mb_strimwidth($c['title_cp'], 0, 100, " ..."); ?></b></h3>

                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                              <i class="fas fa-plus"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-body">
                          <?php if (strlen($c['title_cp']) > 100) : ?>
                            <b>Full Title :</b> <?= $c['title_cp']; ?><br>
                          <?php endif; ?>
                          <b>Clausal :</b> <?= $c['clausal']; ?><br>
                          <b>Evidence :</b> <?= $c['evidence']; ?><br>
                          <b>Keterangan :</b> <br><?= $c['description']; ?>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                          <div>
                            <?php if ($deleteCp == true) : ?>
                              <a href="#" class="btn btn-danger btn-sm float-right btn-hapus-cp" data-id="<?= $c['id_cp']; ?>" style="margin-left: 5px;"><i class="fa fa-trash"></i></a>
                            <?php endif; ?>
                            <a href="#" class="btn btn-primary btn-sm float-right btn-update-cp" data-id="<?= $c['id_cp']; ?>" data-title="<?= $c['title_cp']; ?>" data-clausal="<?= $c['clausal']; ?>" data-evidence="<?= $c['evidence']; ?>" data-desc="<?= $c['description']; ?>" data-area="<?= $c['id_area']; ?>"><i class="fa fa-book"></i></a>
                          </div>
                        </div>
                        <!-- /.card-footer-->
                      </div>
                    <?php endforeach; ?>
                    <!-- /.card -->
                  </div>
                </div>
              </div>
            </section>
            <!-- /.content -->
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
<div class="modal fade" id="modal-add-cp">
  <div class=" modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Check Point</h4>
      </div>
      <form action="/check/save" method="post">
        <?php csrf_field(); ?>
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" id="title" placeholder="Title" name="title_cp" minlength="8" required>
          </div>
          <div class="form-group">
            <label for="clausal">Clausal</label>
            <input type="text" class="form-control" id="clausal" placeholder="Clausal" name="clausal" minlength="2" required>
          </div>
          <div class="form-group">
            <label for="clausal">Evidence</label>
            <input type="text" class="form-control" id="evidence" placeholder="Evidence" name="evidence" minlength="8" required>
          </div>
          <div class="form-group">
            <label for="description">Keterangan</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="5" placeholder="Keterangan" required></textarea>
          </div>


          <div class="modal-footer justify-content-between">
            <input type="hidden" name="uri" id="" value="<?= uri_string(); ?>">
            <input type="hidden" name="tipe" id="" value="system">
            <input type="hidden" name="id_area" id="id_area" value="<?= $id_area; ?>">
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
<div class="modal fade" id="modal-add-cp-exist">
  <div class=" modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Check Point from Existing</h4>
      </div>
      <form action="/check/saveMulti" method="post">
        <?php csrf_field(); ?>
        <div class="modal-body">
          <div class="form-group">
            <label for="category">Pilih Category</label>
            <select name="id_category" id="id_category_detail" class="form-control select2bs4" required>
              <option value="#">--Pilih Check Point dari Category lain--</option>
              <?php foreach ($categoryAll as $ca) : ?>
                <?php if ($ca['id_category'] != $category['id_category']) : ?>
                  <option value="<?= $ca['id_category']; ?>"><?= $ca['title']; ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="modal-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="10">#</th>
                <th>Title</th>
                <th width="100">Clausal</th>
                <th width="10">Pilih</th>
              </tr>
            </thead>
            <tbody id="tr_checkpoint">
            </tbody>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Clausal</th>
                <th>Pilih</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <div id="div_count_cp"></div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" name="id_category" id="id_category" value="<?= $category['id_category']; ?>">
          <input type="hidden" name="" id="id-area-system" value="<?= $id_area; ?>">
          <input type="hidden" name="uri" id="id_category" value="<?= uri_string(); ?>">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>

      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- modal update -->
<div class="modal fade" id="editModal-cp">
  <div class=" modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ubah Check Point</h4>
      </div>
      <form action="/check/update" method="post">
        <?php csrf_field(); ?>
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control title" id="title" placeholder="Title" name="title_cp" minlength="8" required>
          </div>
          <div class="form-group">
            <label for="clausal">Clausal</label>
            <input type="text" class="form-control clausal" id="clausal" placeholder="Clausal" name="clausal" minlength="2" required>
          </div>
          <div class="form-group">
            <label for="clausal">Evidence</label>
            <input type="text" class="form-control evidence" id="evidence" placeholder="Evidence" name="evidence" minlength="8" required>
          </div>
          <div class="form-group">
            <label for="description">Keterangan</label>
            <textarea class="form-control description" name="description" id="description" cols="30" rows="5" placeholder="Keterangan" required></textarea>
          </div>


          <div class="modal-footer justify-content-between">
            <input type="hidden" name="id_cp" id="id_cp" class="id">
            <input type="hidden" name="id_area" id="id_area" class="area-ubah">
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
<div class="modal fade" id="deleteModal-cp">
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