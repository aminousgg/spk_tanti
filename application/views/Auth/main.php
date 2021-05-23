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
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('assets_lte') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <link rel="stylesheet" href="<?= base_url('assets_lte') ?>/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets_lte') ?>/dist/css/adminlte.min.css">

</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="<?= base_url('assets_lte') ?>/index2.html"><b>SPK</b>Tanti</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register</p>

      <?= form_open('auth/register') ?>
        <div class="input-group mb-3">
          <input type="email" name="username" class="form-control" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password1" class="form-control" placeholder="Retype password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      <?= form_close() ?>


      <a href="#" class="text-center">I already have an acount</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="<?= base_url('assets_lte') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets_lte') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url('assets_lte') ?>/plugins/toastr/toastr.min.js"></script>

<!-- AdminLTE App -->
<!-- <script src="<?= base_url('assets_lte') ?>/dist/js/adminlte.min.js"></script> -->

<script>
  
  var notif_1 = "<?= $this->session->flashdata('notif_1') ?>";
  if(notif_1 != "")
  {
    toastr.success(notif_1);
  }
  var notif_0 = "<?= $this->session->flashdata('notif_0') ?>";
  if(notif_0 != "")
  {
    toastr.success(notif_0);
  }

</script>


</body>
</html>
