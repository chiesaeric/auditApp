<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Category</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">Category</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <button class="btn btn-success" data-toggle="modal" data-target="#modal-add-category">Tambah Category</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Tipe</th>
                    <th>Check Point</th>
                    <th>Created At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($category as $c) : ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $c['title']; ?></td>
                      <td><?= $c['type']; ?></td>
                      <td><b><?= $countCat[$c['id_category']]; ?> check point<a href="/category/<?= $c['id_category']; ?>-<?= $c['type'];; ?>" class="btn btn-info btn-sm float-right"><i class="fa fa-eye"></i></a></td>
                      <td><?= date('d M Y', strtotime($c['created_at'])); ?></td>
                      <td style="text-align:center; vertical-align:middle">
                        <a href="#" class="btn btn-warning btn-sm btn-duplicate-category" data-id="<?= $c['id_category']; ?>" data-title="<?= $c['title']; ?>" data-tipe="<?= $c['type']; ?>"><i class="fa fa-copy"></i></a>
                        &NonBreakingSpace;|&NonBreakingSpace;
                        <a href="#" class="btn btn-info btn-sm btn-edit-category" data-id="<?= $c['id_category']; ?>" data-title="<?= $c['title']; ?>" data-tipe="<?= $c['type']; ?>"><i class="fa fa-edit"></i></a>
                        &NonBreakingSpace;|&NonBreakingSpace;
                        <a href="#" class="btn btn-danger btn-sm btn-hapus-category" data-id="<?= $c['id_category']; ?>"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Tipe</th>
                    <th>Check Point</th>
                    <th>Created At</th>
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
<div class="modal fade" id="modal-add-category">
  <div class=" modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Category</h4>
      </div>
      <form action="/category/save" method="post">
        <?php csrf_field(); ?>
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" id="title" placeholder="Title" name="title" minlength="8" required>
          </div>
          <div class="form-group">
            <label for="tipe">Tipe</label>
            <select name="tipe" id="tipe" class="form-control" required>
              <option value="system">System</option>
              <option value="proses">Proses</option>
            </select>
          </div>
          <div class="modal-footer justify-content-between">
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

<!-- Modal Edit Product-->
<div class="modal fade" id="editModal-category">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ubah Category</h4>
      </div>
      <form action="/category/update" method="post">
        <?php csrf_field(); ?>
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control title-category" id="title-category" placeholder="Title" name="title" minlength="8" required>
          </div>
          <div class="form-group">
            <label for="tipe">Tipe</label>
            <select id="tipe" class="form-control tipe-category" id="tipe-category" disabled>
              <option value="system">System</option>
              <option value="proses">Proses</option>
            </select>
          </div>
          <input type="hidden" name="id_category" class="id-category">
          <input type="hidden" name="tipe" class="tipe-category-main">
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Ubah</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit Product-->
<div class="modal fade" id="duplicateModal-category">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-default">
      <div class="modal-header">
        <h4 class="modal-title">Duplicate Category</h4>
      </div>
      <form action="/category/duplicate" method="post">
        <?php csrf_field(); ?>
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" id="title-category" placeholder="Title" name="title" minlength="8" required>
          </div>
          <input type="hidden" name="id_category" class="id-category-dup">
          <input type="hidden" name="tipe" class="tipe-category-dup">
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-info">Duplicate</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal Hapus -->
<div class="modal fade" id="deleteModal-category">
  <div class=" modal-dialog">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Category</h4>
      </div>
      <div class="modal-body">
        Apa anda yakin ingin menghapus category ini?
      </div>
      <form action="/category/delete" method="post">
        <?php csrf_field(); ?>
        <div class="modal-footer justify-content-between">
          <input type="hidden" name="id_category" class="id-category">
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