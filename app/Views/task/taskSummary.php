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
                        <li class="breadcrumb-item active">Task Summary</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Auditor</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Deadline</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $num = 1; ?>
                                    <?php foreach ($audit as $ad) : ?>
                                        <tr>
                                            <td><?= $num++; ?></td>
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
                                                |&NonBreakingSpace;<a href="/taskSummary/detailTask/<?= $ad['id_audit']; ?>" class="btn btn-info btn-sm" data-id="<?= $ad['id_audit']; ?>"><i class="fa fa-eye"></i></a>
                                                <?php if ($ad['status'] == 'in review') : ?>
                                                    |&NonBreakingSpace;<a href="#" class="btn btn-success btn-sm btn-approve-audit" data-id="<?= $ad['id_audit']; ?>"><i class="fa fa-check"></i></a>
                                                <?php endif; ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Auditor</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Deadline</th>
                                        <th>Detail</th>
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
<?= $this->endSection(); ?>