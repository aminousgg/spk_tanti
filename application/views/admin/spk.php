<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $judul ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets_lte') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets_lte') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets_lte') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets_lte') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets_lte') ?>/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php $this->load->view('admin/template/header') ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $this->load->view('admin/template/sidebar') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            
            <section class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h2>
                      Menu utama
                    </h2>
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                  </div>
                </div>
              </div><!-- /.container-fluid -->
            </section>

            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">Hasil Analisis</div>
                  <div class="card-body">
                    <table class="table table-hovered table-bordered tb_pelamar">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Pendidikan</th>
                                <th>Sertifikasi</th>
                                <th>Pengalaman Kerja</th>
                                <th>Nilai Akademik</th>
                                <th>Umur</th>
                                <th>Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php $i=1; foreach($pelamar as $row){ ?>
                                <tr>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['pendidikan'] ?></td>
                                    <td><?= $row['non_pend'] ?></td>
                                    <td><?= $row['pengalaman'] ?></td>
                                    <td><?= $row['nilai'] ?></td>
                                    <td><?= $row['umur'] ?></td>
                                    <td><?= $row['sum'] ?></td>
                                </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
        </div>
    </section>
  </div>



  <!-- Main footer -->
  <?php $this->load->view('admin/template/footer') ?>

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
<script src="<?= base_url('assets_lte') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets_lte') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets_lte') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets_lte') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets_lte') ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets_lte') ?>/dist/js/demo.js"></script>


<script>
  var notip = "<?= $this->session->flashdata('notip'); ?>";
  if(notip!=""){
    alert(notip);
  }


  function del(id){
    if (confirm('Are you sure DELETE this?')) {
      // Save it!
      window.location = "<?= base_url('main/del') ?>/"+id;
    } else {
      // Do nothing!
      console.log('Thing was not saved to the database.');
    }
  }
  $('.tb_pelamar').DataTable({
        "order": [[ 6, "desc" ]],
        "columnDefs": [ {
            "targets": [0,1,2,3,4,5,6],
            "orderable": false
        } ]
    } );
</script>
</body>
</html>
