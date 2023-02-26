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
            <li class="breadcrumb-item active">Detail Task Info</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h5><b>Task Info</b></h5>
            </div>
            <div class="card-body" style="height: 420px">
              <dl class="row">
                <dt class="col-sm-4">Reporter <i class="fa fa-user"></i></dt>
                <dd class="col-sm-8"></i><?= $reporter['nama']; ?></dd>
                <dt class="col-sm-4">Auditor <i class="fa fa-user"></i></dt>
                <dd class="col-sm-8"><?= $auditor['nama']; ?></dd>
                <dt class="col-sm-4">Category <i class="fas fa-chart-pie"></i></dt>
                <dd class="col-sm-8"><?= $category['title']; ?></dd>
                <dt class="col-sm-4">Status</dt>
                <dd class="col-sm-8">
                  <?php if ($audit['status'] == 'backlog') { ?>
                    <span class="badge bg-default bg-xl">Backlog</span>
                  <?php } else if ($audit['status'] == 'to do') { ?>
                    <span class="badge bg-danger bg-xl">To do</span>
                  <?php } else if ($audit['status'] == 'in progress') { ?>
                    <span class="badge bg-info bg-xl">In Progress</span>
                  <?php } else if ($audit['status'] == 'in review') { ?>
                    <span class="badge bg-warning bg-xl">In Review</span>
                  <?php } else if ($audit['status'] == 'done') { ?>
                    <span class="badge bg-success bg-xl">Done</span>
                  <?php } ?>
                </dd>
                <dt class="col-sm-4">Total Check Point</dt>
                <dd class="col-sm-8"><?= $allCp; ?> Point</dd>
                <dt class="col-sm-4">Deadline</dt>
                <dd class="col-sm-8"><?= date('d M Y', strtotime($audit['deadline'])); ?></dd>
                <dt class="col-sm-4">Findings</dt>
                <dd class="col-sm-8"><span class="badge bg-danger bg-xl"><?= $allFin; ?> findings</span></dd>
                </dd>
              </dl>
            </div>
            <input type="hidden" name="" id="todo" value="<?= $todo; ?>">
            <input type="hidden" name="" id="passed" value="<?= $passed; ?>">
            <input type="hidden" name="" id="failed" value="<?= $failed; ?>">
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h5><b>Task Chart</b></h5>
            </div>
            <div class="card-body" style="height: 420px">
              <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                  <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                </div>
                <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                  <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                </div>
              </div> <canvas id="chart-line" width="299" height="200" class="chartjs-render-monitor" style="display: block; width: 299px; height: 200px;"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5><b>Detail Task Info</b></h5>
          </div>
          <div class="card-body">
            <div class="card-body">
              <div class="row">
                <div class="col-3 col-sm-2">
                  <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                    <?php $no = 1; ?>
                    <?php foreach ($detailTask as $dt) : ?>
                      <?php if ($no == 1) { ?>
                        <a class="nav-link active" id="vert-tabs-point-tab" data-toggle="pill" href="#vert-tabs-point<?= $no; ?>" role="tab" aria-controls="vert-tabs-profile" aria-selected="true">Point <?= $no; ?></a>
                      <?php } else { ?>
                        <a class="nav-link" id="vert-tabs-point-tab" data-toggle="pill" href="#vert-tabs-point<?= $no; ?>" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Point <?= $no; ?></a>
                      <?php } ?>
                      <?php $no++; ?>
                    <?php endforeach; ?>
                  </div>
                </div>
                <div class="col-9 col-sm-10">
                  <div class="tab-content" id="vert-tabs-tabContent">
                    <?php $nos = 1; ?>
                    <?php foreach ($detailTask as $ds) : ?>
                      <?= $status = ''; ?>
                      <?php if ($nos == 1) { ?>
                        <?php $status = 'tab-pane fade show active' ?>
                      <?php } else { ?>
                        <?php $status = 'tab-pane fade' ?>
                      <?php } ?>
                      <div class="<?= $status; ?>" id="vert-tabs-point<?= $nos; ?>" role="tabpanel" aria-labelledby="vert-tabs-point-tab">
                        <dl>
                          <dt>Auditee <i class="fa fa-user"></i></dt>
                          <dd><?= $ds['nama_audity']; ?></dd>
                          <dt>Check Point</dt>
                          <dd><?= $ds['title_cp']; ?></dd>
                          <dt>Clausal</dt>
                          <dd><?= ($ds['clausal'] == "") ? "-" : $ds['clausal']; ?></dd>
                          <dt>Evidence</dt>
                          <dd><?= $ds['evidence']; ?></dd>
                          <dt>Keterangan</dt>
                          <dd><?= $ds['description']; ?></dd>
                          <dt>Hasil</dt>
                          <dd>
                            <?php if ($ds['status'] == 'to do') { ?>
                              <span class="badge bg-gray bg-xl">To Do</span>
                            <?php } else if ($ds['status'] == 'passed') { ?>
                              <span class="badge bg-success bg-xl">Passed</span>
                            <?php } else if ($ds['status'] == 'failed') { ?>
                              <span class="badge bg-danger bg-xl">Failed</span>
                            <?php } ?>
                          </dd>
                          <?php if ($ds['status'] != 'to do') : ?>
                            <dt>Keterangan Hasil</dt>
                            <dd><?= $ds['desc_audit']; ?></dd>
                            <dt>Dokumentasi</dt>
                            <?php if ($ds['file_path'] != "") { ?>
                              <?php if (str_contains($ds['file_path'], '.pdf')) : ?>
                                <dd><a class="btn btn-info btn-sm btn-dokumen-pdf" data-id="<?= $ds['file_path']; ?>">Check Dokumentasi</a></dd>
                              <?php else : ?>
                                <dd><a class="btn btn-info btn-sm btn-dokumen-jpg" data-id="<?= $ds['file_path']; ?>">Check Dokumentasi</a></dd>
                              <?php endif ?>
                            <?php } else { ?>
                              <dd>Tidak ada dokumentasi</dd>
                            <?php } ?>
                            <?php foreach ($finding as $fi) : ?>
                              <?php if ($fi['id_detail_audit'] == $ds['id_detail_audit'] and $fi['status_finding'] != "non") : ?>
                                <dt>Category Finding</dt>
                                <dd>
                                  <?php if ($fi['category_finding'] == 'none') { ?>
                                    <span class="badge bg-gray bg-xl">Belum diset</span>
                                  <?php } else if ($fi['category_finding'] == 'major') { ?>
                                    <span class="badge bg-danger bg-xl">Major</span>
                                  <?php } else if ($fi['category_finding'] == 'minor') { ?>
                                    <span class="badge bg-warning bg-xl">Minor</span>
                                  <?php } else if ($fi['category_finding'] == 'observation') { ?>
                                    <span class="badge bg-info bg-xl">Observation</span>
                                  <?php } ?>
                                </dd>
                                <dt>Cause</dt>
                                <dd>
                                  <?php if ($fi['cause'] == "") : ?>
                                    -
                                  <?php else : ?>
                                    <textarea name="cause" class="form-control" cols="30" rows="10" disabled><?= $fi['cause']; ?></textarea>
                                  <?php endif; ?>
                                </dd>
                                <dt>Countermeasure and countermeasure impact</dt>
                                <dd>
                                  <?php if ($fi['short_term'] == "") : ?>
                                    -
                                  <?php else : ?>
                                    <?= $fi['short_term']; ?>
                                  <?php endif; ?>
                                </dd>
                                <dt>Corrective action and Corrective action impact</dt>
                                <dd>
                                  <?php if ($fi['long_term'] == "") : ?>
                                    -
                                  <?php else : ?>
                                    <?= $fi['long_term']; ?>
                                  <?php endif; ?>
                                </dd>
                                <dt>Related document that need to be revised</dt>
                                <dd>
                                  <?php if ($fi['revised'] == "") : ?>
                                    -
                                  <?php else : ?>
                                    <?= $fi['revised']; ?>
                                  <?php endif; ?>
                                </dd>
                              <?php endif; ?>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </dl>
                      </div>
                      <?php $nos++; ?>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</div>
</section>
</div>

<!-- modal Hapus -->
<div class="modal fade" id="dokumenModal-jpg">
  <div class=" modal-dialog">
    <div class="modal-content bg-default">
      <div class="modal-header">
        <h4 class="modal-title">Dokumentasi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: center;">
        <img src="" style="margin-top: 10px;" class="img-thumbnail id-jpg" id="">
      </div>
      <div class="modal-footer justify-content-between">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- modal Hapus -->
<div class="modal fade" id="dokumenModal-pdf">
  <div class=" modal-dialog modal-xl">
    <div class="modal-content bg-default">
      <div class="modal-header">
        <h4 class="modal-title">Dokumentasi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: center;">
        <embed src="" width="800px" height="2100px" class="id-pdf" />
      </div>
      <div class="modal-footer justify-content-between">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= $this->endSection(); ?>