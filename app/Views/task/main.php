<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Audit Task</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Task</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-success" data-toggle="modal" data-target="#modal-add">Tambah Task</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Task</th>
                                        <th>Nama Auditor</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Deadline</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $num = 1; ?>
                                    <?php foreach ($audit as $ad) : ?>
                                        <tr>
                                            <td><?= $num++; ?></td>
                                            <td><?= $ad['task_name']; ?></td>
                                            <td><?= $ad['id_assigne']; ?></td>
                                            <td><?= $ad['id_category']; ?></td>
                                            <td>
                                                <?php if ($ad['status'] == 'backlog') { ?>
                                                    <span class="badge bg-default bg-lg">Backlog</span>
                                                <?php } else if ($ad['status'] == 'to do') { ?>
                                                    <span class="badge bg-danger bg-lg">To do</span>
                                                <?php } else if ($ad['status'] == 'in progress') { ?>
                                                    <span class="badge bg-info bg-lg">In Progress</span>
                                                <?php } else if ($ad['status'] == 'in review') { ?>
                                                    <span class="badge bg-warning bg-lg">In Review</span>
                                                <?php } else if ($ad['status'] == 'done') { ?>
                                                    <span class="badge bg-success bg-lg">Done</span>
                                                <?php } ?>
                                            </td>
                                            <td><?= date('d M Y', strtotime($ad['deadline'])); ?></td>
                                            <td>
                                                <a href="/taskSummary/detail/<?= $ad['id_audit']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-book"></i></a>
                                                |&NonBreakingSpace;<a href="/taskSummary/detailTask/<?= $ad['id_audit']; ?>" class="btn btn-warning btn-sm" data-id="<?= $ad['id_audit']; ?>"><i class="fa fa-eye"></i></a>

                                                <?php if ($ad['status'] == 'in review' || $ad['status'] == 'done') : ?>
                                                    |&NonBreakingSpace;<a href="#" class="btn bg-indigo btn-sm btn-report-audit" data-id="<?= $ad['id_audit']; ?>"><i class="fas fa-chart-pie"></i></a>
                                                <?php endif; ?>

                                                <?php if ($ad['status'] == 'in review') : ?>
                                                    |&NonBreakingSpace;<a href="#" class="btn btn-success btn-sm btn-approve-audit" data-id="<?= $ad['id_audit']; ?>"><i class="fa fa-check"></i></a>
                                                <?php endif; ?>

                                                <?php if ($ad['status'] == 'to do') : ?>
                                                    |&NonBreakingSpace;<a href="#" class="btn btn-info btn-sm btn-edit-audit" data-id="<?= $ad['id_audit']; ?>" data-name="<?= $ad['task_name']; ?>" data-assigne="<?= $ad['assigne']; ?>" data-category="<?= $ad['category']; ?>" data-deadline="<?= $ad['deadline']; ?>"><i class="fa fa-edit"></i></a>
                                                    |
                                                    <a href="#" class="btn btn-danger btn-sm btn-hapus-audit" data-id="<?= $ad['id_audit']; ?>"><i class="fa fa-trash"></i></a>
                                                <?php endif; ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Reporter</th>
                                        <th>Nama Auditor</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Deadline</th>
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
                <h4 class="modal-title">Tambah Task</h4>
            </div>
            <form action="task/save" method="post" onsubmit="return validationForm()">
                <?php csrf_field(); ?>
                <div class="modal-body">
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <b><i class="icon fas fa-info"></i>Info</b><br>
                        Mohon lengkapi check point di category yg akan dipilih terlebih dahulu, karena jika ada tambahan setelah task di buat maka check point tersebut tidak tertambah di task ini.
                    </div>
                    <div class="form-group">
                        <label for="">Nama Task</label>
                        <input type="text" name="task_name" id="" class="form-control" placeholder="Nama Task" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Auditor</label>
                        <select name="id_assigne" id="id-assigne" class="form-control select2bs4" required>
                            <option selected="selected">--Pilih Auditor--</option>
                            <?php foreach ($user as $u) : ?>
                                <option value="<?= $u['id_users']; ?>"><?= $u['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Category</label>
                        <select name="id_category" id="id-category" class="form-control select2bs4" required>
                            <option value="#" selected>--Pilih Category--</option>
                            <?php foreach ($category as $c) : ?>
                                <option value="<?= $c['id_category']; ?>"><?= $c['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Deadline</label>
                        <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                            <input type="text" id="deadline" class="form-control datetimepicker-input" data-target="#reservationdatetime" name="deadline" autocomplete="off" required>
                            <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="hidden" name="id_reporter" id="id-reporter" value="<?= session()->get('id_user'); ?>">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="input-task">Simpan</button>
                    </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- modal -->
<div class="modal fade" id="editModal-audit">
    <div class=" modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ubah Task</h4>
            </div>
            <form action="task/update" method="post" onsubmit="return validationForm2()">
                <?php csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Task</label>
                        <input type="text" name="task_name" id="" class="form-control task-name" placeholder="Nama Task" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Auditor</label>
                        <select name="id_assigne" id="id-assigne2" class="form-control assigne select2bs4" required>
                            <option value="#" selected>--Pilih Auditor--</option>
                            <?php foreach ($user as $u) : ?>
                                <option value="<?= $u['id_users']; ?>"><?= $u['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Category</label>
                        <select name="id_category" id="id-category2" class="form-control id-category select2bs4" required>
                            <option value="#" selected>--Pilih Category--</option>
                            <?php foreach ($category as $c) : ?>
                                <option value="<?= $c['id_category']; ?>"><?= $c['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Deadline</label>
                        <div class="input-group date" id="reservationdatetime-update" data-target-input="nearest">
                            <input type="text" id="deadline2" class="form-control datetimepicker-input deadline" data-target="#reservationdatetime-update" name="deadline" autocomplete="off" required>
                            <div class="input-group-append" data-target="#reservationdatetime-update" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="hidden" name="id_audit" id="id-reporter" value="" class="id-audit">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="input-task-update">Simpan</button>
                    </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- modal Hapus -->
<div class="modal fade" id="deleteModal-audit">
    <div class=" modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Task</h4>
            </div>
            <div class="modal-body">
                Apa anda yakin ingin menghapus Task ini?
            </div>
            <form action="/task/delete" method="post">
                <?php csrf_field(); ?>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="id_audit" class="id-audit">
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
<div class="modal fade" id="approveModal-audit">
    <div class=" modal-dialog">
        <div class="modal-content bg-success">
            <div class="modal-header">
                <h4 class="modal-title">Approve Task</h4>
            </div>
            <div class="modal-body">
                Apa anda yakin ingin menyetujui Task ini bahwa sudah selesai?
            </div>
            <form action="/taskSummary/approve/" method="post">
                <?php csrf_field(); ?>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="id_audit" class="id-audit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-outline-light">Approve</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- modal Hapus -->
<div class="modal fade" id="reportModal-audit">
    <div class=" modal-dialog">
        <div class="modal-content bg-default">
            <div class="modal-header">
                <h4 class="modal-title">Report Task</h4>
            </div>
            <div class="modal-body">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" name="result" id="customCheckbox2" checked="">
                    <label for="customCheckbox2" class="custom-control-label">Result Report</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" name="detail" id="customCheckbox2" checked="">
                    <label for="customCheckbox2" class="custom-control-label">Detail Report</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" name="finding" id="customCheckbox2" checked="">
                    <label for="customCheckbox2" class="custom-control-label">Finding Report</label>
                </div>
            </div>
            <form action="/taskSummary/approve/" method="post">
                <?php csrf_field(); ?>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="id_audit" class="id-audit-report">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn bg-indigo">Generate Report</button>
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