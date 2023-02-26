<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Audit Finding</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Finding</li>
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
                                        <th>Finding</th>
                                        <th>Status</th>
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
                                            <td><?= $arrFind[$ad['id_audit']]; ?> Findings</td>
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
                                            <td>
                                                <a class="btn btn-info btn-sm btn-detail-finding" data-id="<?= $ad['id_audit']; ?>"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Auditor</th>
                                        <th>Category</th>
                                        <th>Finding</th>
                                        <th>Status</th>
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
            <div class="row mb-2" id="detail-Finding-content" style="display: none;">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Finding</h5>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Check Point</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="detail-finding">
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row mb-2" id="detail-data-finding-content" style="display: none;">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Detail Finding</h5>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="card collapsed-card card-info" style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                                <div class="card-header" data-card-widget="collapse" title="Collapse">
                                    <h5 class="card-title">Detail Check Point</h5>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                            <i class="fas fa-expand"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <tbody id="detail-cp">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <form action="/finding/save" method="post" enctype="multipart/form-data">
                                <?php csrf_field(); ?>
                                <div class="row" id="form-update-finding">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <select name="status_finding" id="status-finding" class="form-control">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Category</label>
                                            <select name="category_finding" id="category-finding" class="form-control" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="">Keterangan</label>
                                            <input type="text" name="desc_audit" id="desc-audit" class="form-control" placeholder="Keterangan Finding" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Cause (5 Why)</label>
                                            <textarea name="cause" class="form-control" cols="30" rows="10" id="cause"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Countermeasure and countermeasure impact</label>
                                            <input type="text" name="short_term" id="short-audit" class="form-control" placeholder="Isi field ini jika finding">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Corrective action and Corrective action impact</label>
                                            <input type="text" name="long_term" id="long-audit" class="form-control" placeholder="Isi field ini jika finding">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Related document that need to be revised</label>
                                            <input type="text" name="revised" id="revised-audit" class="form-control" placeholder="Isi field ini jika finding">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Bukti</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input foto" id="foto" name="file_path" data-number="">
                                                <label class="custom-file-label" id="label" for="customFile">Choose file</label>
                                            </div>
                                            <img src="/img/default.png" style="margin-top: 10px;" class="img-thumbnail" id="img-preview">
                                        </div>
                                        <input type="hidden" name="id_audit" id="id-audit" value="">
                                        <input type="hidden" name="id_detail_audit" id="id-detail-audit" value="">
                                        <input type="hidden" name="id_finding" id="id-finding" value="">
                                        <button type="submit" class="btn btn-success">Ubah Finding</button>
                                    </div>
                                </div>
                            </form>
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

<?= $this->endSection(); ?>