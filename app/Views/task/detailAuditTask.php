<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $audit['task_name']; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/task">Task</a></li>
                        <li class="breadcrumb-item active">Detail Audit Task</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row mb-2">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-4">
                                    <b>Reporter : </b><?= $reporter['nama']; ?><br>
                                    <b>Auditor : </b><?= $auditor['nama']; ?><br>
                                    <b>Category : </b><?= $category['title']; ?>
                                </div>
                                <div class="col-8">
                                    <div class="float-right">
                                        <b>Status : </b>
                                        <?php if ($audit['status'] == 'backlog') { ?>
                                            <b>Backlog</b>
                                        <?php } else if ($audit['status'] == 'to do') { ?>
                                            <b>To Do</b>
                                        <?php } else if ($audit['status'] == 'in progress') { ?>
                                            <b>In Progress</b>
                                        <?php } else if ($audit['status'] == 'in review') { ?>
                                            <b>In Review</b>
                                        <?php } else if ($audit['status'] == 'done') { ?>
                                            <b>Done</b>
                                        <?php } ?>
                                        <br>
                                        <b>Deadline : </b><?= date('d M Y', strtotime($audit['deadline'])); ?><br>
                                        <b style="text-align: right;">Total Check Point (<?= $doneCp; ?>/<?= $allCp; ?>)</b><br>
                                        <span class="badge bg-gray">To do</span>
                                        <span class="badge bg-success">Passed</span>
                                        <span class="badge bg-danger">Failed</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php $no = 1; ?>
                            <?php foreach ($area as $ar) : ?>
                                <div style="margin-top: 10px;">
                                    <h5 class="d-inline-block"><b><?= ucwords($ar['nama_area']); ?></b></h5>
                                    <a class="btn btn-info btn-sm d-sm-inline-block float-right btn-audity-audit" data-id="<?= $ar['id_area']; ?>">Auditee</a>
                                </div>
                                <hr style="border: 1px solid black;">
                                <?php $nos = 1; ?>
                                <?php foreach ($detailTask as $ds) : ?>
                                    <?php if ($ar['id_area'] == $ds['id_area']) : ?>
                                        <!-- Verification -->
                                        <?php
                                        $color = "card-gray";
                                        if ($ds['status'] == "passed") {
                                            $color = "card-success";
                                        } else if ($ds['status'] == "failed") {
                                            $color = "card-danger";
                                        }
                                        $dataValidation = "collapsed-card";
                                        $iconValidation = "fa-plus";

                                        if (session()->has('alert') and session()->get('id') == $ds['id_detail_audit']) {
                                            $dataValidation = "";
                                            $iconValidation = "fa-minus";
                                            $color = "card-warning";
                                        }
                                        ?>
                                        <!-- end verification -->

                                        <div class="card <?= $dataValidation; ?> <?= $color; ?>" style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                                            <!-- Card header -->
                                            <div class="card-header" data-card-widget="collapse" title="Collapse">
                                                <h3 class="card-title">Check Point <?= $nos; ?></h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                                        <i class="fas fa-expand"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                        <i class="fas <?= $iconValidation; ?>"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- end card header -->
                                            <!-- card body -->
                                            <?php if ($ds['nama_audity'] == "") : ?>
                                                <div class="card-body">
                                                    <div class="callout callout-danger">
                                                        <h5>Perhatian!</h5>
                                                        <p>Mohon masukan nama audity terlebih dahulu pada button audity</p>
                                                    </div>
                                                </div>
                                            <?php else : ?>
                                                <div class="card-body">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 20%;">Detail Point</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Check Point</td>
                                                                <td><?= $ds['title_cp']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Clausal</td>
                                                                <td>
                                                                    <?php if ($ds['clausal'] == "") {
                                                                        echo "-";
                                                                    } else {
                                                                        echo $ds['clausal'];
                                                                    } ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Evidence</td>
                                                                <td><?= $ds['evidence']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Keterangan</td>
                                                                <td><?= $ds['description']; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <!-- input data -->
                                                    <?php if (session()->has('alert')) : ?>
                                                        <div class="alert alert-warning alert-dismissible">
                                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                                                            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                                                            <?= session('alert'); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <form action="/taskSummary/saveDetail" method="post" enctype="multipart/form-data">
                                                        <?php csrf_field(); ?>
                                                        <div class="row" style="margin-top: 10px;">
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="">Nama Auditee</label>
                                                                    <input type="text" name="nama_audity" id="" class="form-control" value="<?= $ds['nama_audity']; ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Hasil</label>
                                                                    <Select class="form-control" name="status<?= $no; ?>" required>
                                                                        <?php if (old('status' . $no, $ds['status']) == "to do") { ?>
                                                                            <option value="#" selected>--Pilih Hasil--</option>
                                                                            <option value="passed">Passed</option>
                                                                            <option value="failed">Failed</option>
                                                                        <?php } else if (old('status' . $no, $ds['status']) == "passed") { ?>
                                                                            <option value="passed" selected>Passed</option>
                                                                            <option value="failed">Failed</option>
                                                                        <?php } else if (old('status' . $no, $ds['status']) == "failed") { ?>
                                                                            <option value="passed">Passed</option>
                                                                            <option value="failed" selected>Failed</option>
                                                                        <?php } ?>
                                                                    </Select>
                                                                    <div class="form-group">
                                                                        <label for="">Bukti</label>
                                                                        <div class="custom-file">
                                                                            <input type="file" class="custom-file-input foto" id="foto<?= $no; ?>" name="file_path<?= $no; ?>" data-number="<?= $no; ?>">
                                                                            <label class="custom-file-label" id="label<?= $no; ?>" for="customFile">Choose file</label>
                                                                        </div>
                                                                        <?php
                                                                        if ($ds['file_path'] == "") {
                                                                            $filePath = "/img/default.png";
                                                                        } else if (str_contains($ds['file_path'], 'pdf')) {
                                                                            $filePath = "/img/dokumen.jpeg";
                                                                        } else {
                                                                            $filePath = base_url() . "/img" . $ds['file_path'];
                                                                        }
                                                                        ?>
                                                                        <img src="<?= $filePath; ?>" style="margin-top: 10px;" class="img-thumbnail" id="img-preview<?= $no; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-8">
                                                                <div class="form-group">
                                                                    <label for="">Keterangan</label>
                                                                    <textarea name="desc_audit<?= $no; ?>" class="form-control" id="" cols="30" rows="10" required><?= old('desc_audit' . $no, $ds['desc_audit']); ?></textarea>
                                                                </div>
                                                                <input type="hidden" name="id_detail_audit<?= $no; ?>" id="" value="<?= $ds['id_detail_audit']; ?>">
                                                                <input type="hidden" name="id_audit<?= $no; ?>" id="" value="<?= $ds['id_audit']; ?>">
                                                                <input type="hidden" name="no" id="" value="<?= $no; ?>">
                                                                <?php
                                                                $button = "";
                                                                if (old('status' . $no, $ds['status']) == "to do") {
                                                                    $button = "Simpan Hasil";
                                                                    $classButton = 'btn-success';
                                                                } else if (old('status' . $no, $ds['status']) == "to do" && session()->has('alert')) {
                                                                    $button = "Simpan Hasil";
                                                                    $classButton = 'btn-success';
                                                                } else {
                                                                    $button = "Ubah Hasil";
                                                                    $classButton = 'btn-info';
                                                                } ?>
                                                                <button type="submit" class="btn <?= $classButton; ?> float-right" style="margin-left: 5px;"><?= $button; ?></button>
                                                                <?php if ($ds['file_path'] != "") : ?>
                                                                    <a class="btn btn-danger float-right btn-hapus-foto" data-idDetail="<?= $ds['id_detail_audit']; ?>" data-idAudit="<?= $ds['id_audit']; ?>">Hapus Dokumen</a>
                                                                <?php endif; ?>

                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- end input data -->
                                                </div>
                                            <?php endif; ?>
                                            <!-- end card body -->
                                            <!-- card footer -->
                                            <div class="card-footer">
                                            </div>
                                            <!-- end card footer -->
                                        </div>

                                        <?php $nos++ ?>
                                        <?php $no++ ?>
                                    <?php endif ?>



                                <?php endforeach; ?>
                                <!-- /.card-footer-->

                            <?php endforeach; ?>
                        </div>
                        <div class="card-footer">
                            <?php if ($audit['status'] == "in review") : ?>
                                <a href="#" class="btn btn-success btn-approve-audit" data-id="<?= $audit['id_audit']; ?>">Approve Task?</a>
                            <?php endif; ?>
                        </div>

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
<div class="modal fade" id="deleteModal-foto">
    <div class=" modal-dialog">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Dokumen</h4>
            </div>
            <div class="modal-body">
                Apa anda yakin ingin menghapus Dokumen ini?
            </div>
            <form action="/taskSummary/deleteFoto" method="post">
                <?php csrf_field(); ?>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="id_detail_audit" class="id-Detail">
                    <input type="hidden" name="id_audit" class="id-Audit">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-outline-light">Hapus</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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

<!-- modal Hapus -->
<div class="modal fade" id="audityModal-audit">
    <div class=" modal-dialog">
        <div class="modal-content bg-default">
            <form action="/taskSummary/audity/" method="post">
                <?php csrf_field(); ?>
                <div class="modal-header">
                    <h4 class="modal-title">Auditee</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="audity">Nama Auditee</label>
                        <input type="text" name="audity_name" id="" class="form-control audity-name" placeholder="Nama Auditee" required>
                    </div>
                </div>


                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="id_area" class="id-area">
                    <input type="hidden" name="id_audit" class="" value="<?= $audit['id_audit']; ?>">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= $this->endSection(); ?>