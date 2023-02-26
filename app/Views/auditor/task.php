<?= $this->extend('layout_auditor/template'); ?>

<?= $this->section('content_audit'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6"></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">Task</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <section class="content">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Task Auditor <b>(<?= Date("F"); ?>)</b></h5>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 10%;">#</th>
                    <th style="width: 60%;">Task</th>
                    <th>Total Point</th>
                    <th style="width: 10%">Status</th>
                    <th style="width: 10%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($audit as $ad) :
                  ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $ad['id_category']; ?></td>
                      <td><?= $arrDetail[$ad['id_audit']]; ?> point</td>
                      <td>

                        <?php
                        $color = '';
                        $toltip = '';
                        if ($ad['status'] == "to do") {
                          $color = 'bg-danger';
                        } else if ($ad['status'] == "in progress") {
                          $color = 'bg-info';
                        } else if ($ad['status'] == "in review") {
                          $color = 'bg-warning';
                        } else if ($ad['status'] == "done") {
                          $color = 'bg-success';
                          $toltip = 'data-toggle="tooltip" data-placement="top" title="Silahkan hubungi lead jika ingin mengubah task"';
                        } ?>
                        <span class="badge <?= $color; ?>" <?= $toltip; ?>><?= $ad['status']; ?></span>
                      </td>
                      <td>
                        <?php
                        if ($ad['status'] == "done") { ?>
                          <button class="btn btn-sm btn-info" disabled><i class="fa fa-book"></i></button>
                        <?php } else { ?>
                          <a href="detail/<?= $ad['id_audit']; ?>" class="btn btn-sm btn-info"><i class="fa fa-book"></i></a>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?= $this->endSection(); ?>