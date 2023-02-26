<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-success" data-toggle="modal" data-target="#modal-add">Tambah User</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Tipe</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($users as $u) : ?>
                                        <tr style="text-align:center; vertical-align:middle">
                                            <td><?= $no++; ?></td>
                                            <td><?= $u['nama']; ?></td>
                                            <td><?= $u['username']; ?></td>
                                            <td><?= $u['tipe']; ?></td>
                                            <td>
                                                <?php if ($u['status'] == "active") { ?>
                                                    <a href="#" class="btn btn-success btn-sm btn-status-deactive" data-id="<?= $u['id_users']; ?>">Active</a>
                                                <?php } else { ?>
                                                    <a href="#" class="btn btn-danger btn-sm btn-status-active" data-id="<?= $u['id_users']; ?>">Deactive</a>
                                                <?php } ?>
                                            </td>
                                            <td><?= date('d M Y', strtotime($u['updated_at'])); ?></td>
                                            <!-- <td style="text-align:center; vertical-align:middle"><button class="btn btn-primary" data-toggle="modal" data-target="#modal-update-<?= $u['id_users']; ?>"><i class="fa fa-edit"></i></button>&NonBreakingSpace;|&NonBreakingSpace;<button class="btn btn-danger"><i class="fa fa-trash"></i></button></td> -->
                                            <td>
                                                <a href="#" class="btn btn-info btn-sm btn-edit-users" data-id="<?= $u['id_users']; ?>" data-name="<?= $u['nama']; ?>" data-username="<?= $u['username']; ?>" data-password="<?= $u['password']; ?>" data-tipe="<?= $u['tipe']; ?>"><i class="fa fa-edit"></i></a>
                                                &NonBreakingSpace;|&NonBreakingSpace;
                                                <a href="#" class="btn btn-danger btn-sm btn-hapus-users" data-id="<?= $u['id_users']; ?>"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Tipe</th>
                                        <th>Status</th>
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
<div class="modal fade" id="modal-add">
    <div class=" modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Users</h4>
            </div>
            <form action="/users/save" method="post">
                <?php csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" minlength="8" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Username" name="username" minlength="8" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="text" class="form-control" id="password" placeholder="Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tipe</label>
                        <select name="tipe" id="" class="form-control">
                            <option value="#" selected>--Pilih Tipe--</option>
                            <option value="lead">Lead Auditor</option>
                            <option value="auditor">Auditor</option>
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
<div class="modal fade" id="editModal-users">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Users</h4>
            </div>
            <form action="/users/update" method="post">
                <?php csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" class="form-control nama-users" id="nama-users" placeholder="Nama" name="nama" minlength="8" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" class="form-control username" id="username" placeholder="Username" name="username" minlength="8" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="text" class="form-control" id="" placeholder="Masukan password baru jika ingin diubah" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tipe</label>
                        <select name="tipe" id="" class="form-control tipe">
                            <option value="#" selected>--Pilih Tipe--</option>
                            <option value="lead">Lead Auditor</option>
                            <option value="auditor">Auditor</option>
                        </select>
                    </div>
                    <input type="hidden" name="id_users" class="id-users">
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal Hapus -->
<div class="modal fade" id="deleteModal-users">
    <div class=" modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Users</h4>
            </div>
            <div class="modal-body">
                Apa anda yakin ingin menghapus akun ini?
            </div>
            <form action="/users/delete" method="post">
                <?php csrf_field(); ?>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="id_users" class="id-users">
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

<!-- modal Hapus -->
<div class="modal fade" id="statusModal-active">
    <div class=" modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Deactive Users</h4>
            </div>
            <div class="modal-body">
                Apa anda yakin ingin deactive akun ini?
            </div>
            <form action="/users/update" method="post">
                <?php csrf_field(); ?>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="id_users" class="id-users">
                    <input type="hidden" name="status" value="deactive">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-outline-light">Deactive</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- modal Hapus -->
<div class="modal fade" id="statusModal-deactive">
    <div class=" modal-dialog">
        <div class="modal-content bg-success">
            <div class="modal-header">
                <h4 class="modal-title">Active Users</h4>
            </div>
            <div class="modal-body">
                Apa anda yakin ingin Activekan akun ini?
            </div>
            <form action="/users/update" method="post">
                <?php csrf_field(); ?>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="id_users" class="id-users">
                    <input type="hidden" name="status" value="active">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-outline-light">Active</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- End Modal Edit Product-->
<?= $this->endSection(); ?>