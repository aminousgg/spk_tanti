<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
<link rel="icon" href="<?php echo base_url(); ?>assets/img/icon.ico" type="image/x-icon"/>
<!-- CSS Files -->
<script src="<?php echo base_url(); ?>assets/js/plugin/webfont/webfont.min.js"></script>
<script>
    WebFont.load({
        google: {"families":["Lato:300,400,700,900"]},
        custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?php echo base_url(); ?>assets/css/fonts.min.css']},
        active: function() {
            sessionStorage.fonts = true;
        }
    });
</script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/atlantis.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/demo.css">