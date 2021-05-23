<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Siswa</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets_lte') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets_lte') ?>/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php $this->load->view('template/header') ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $this->load->view('template/sidebar') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 mx-auto">
                  
                <div class="card">
                  <div class="card-header">Edit data siswa</div>
                  <div class="card-body">
                    <?= form_open('main/edit_in') ?>
                      <input type="hidden" name="id" value="<?= $isi['id'] ?>">
                      <label>Nama</label>
                      <input type="text" value="<?= $isi['nama'] ?>" name="nama" class="form-control" required>
                      <!--  -->
                      <label>Kelas</label>
                      <select class="form-control" name="id_kelas" required>
                        <option value="">-- Pilih Kelas --</option>
                        <?php foreach ($kelas as $row) { ?>
                          <option value="<?= $row->id ?>" <?php if($row->id == $isi['id_kelas']){ echo "selected"; } ?>  ><?= $row->nama_kelas ?></option>
                        <?php } ?>
                      </select>
                      <!--  -->
                      <label>Jenis Kelamin</label>
                      <select class="form-control" name="id_jkel" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <?php foreach ($jkel as $row) { ?>
                          <option value="<?= $row->id ?>" <?php if($row->id == $isi['id_jkel']){ echo "selected"; } ?> ><?= $row->nama_jkel ?></option>
                        <?php } ?>
                      </select>
                      <!--  -->
                      <label>Golongan Darah</label>
                      <select class="form-control" name="id_gol_darah" required>
                        <option value="">-- Pilih Goldar --</option>
                        <?php foreach ($goldar as $row) { ?>
                          <option value="<?= $row->id ?>" <?php if($row->id == $isi['id_gol_darah']){ echo "selected"; } ?>><?= $row->nama_goldar ?></option>
                        <?php } ?>
                      </select>


                      <button class="btn btn-success" type="submit">Submit</button>
                    <?= form_close() ?>
                  </div>
                </div>

              </div>
            </div>
        </div>
    </section>
  </div>



  <!-- Main footer -->
  <?php $this->load->view('template/footer') ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets_lte') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets_lte') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets_lte') ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets_lte') ?>/dist/js/demo.js"></script>


<script>
  var notip = "<?= $this->session->flashdata('notip'); ?>";
  if(notip!=""){
    alert(notip);
  }
</script>
</body>
</html>
