<!-- Logo Header -->
<div class="logo-header" data-background-color="blue">

<a href="index.html" class="logo">
    <img src="<?php echo base_url(); ?>assets/img/logo.svg" alt="navbar brand" class="navbar-brand">
</a>
<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon">
        <i class="icon-menu"></i>
    </span>
</button>
<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
<div class="nav-toggle">
    <button class="btn btn-toggle toggle-sidebar">
        <i class="icon-menu"></i>
    </button>
</div>
</div>
<!-- End Logo Header -->

<!-- Navbar Header -->
<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

<div class="container-fluid">
    <div class="collapse" id="search-nav">
        <form class="navbar-left navbar-form nav-search mr-md-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="submit" class="btn btn-search pr-1">
                        <i class="fa fa-search search-icon"></i>
                    </button>
                </div>
                <input type="text" placeholder="Search ..." class="form-control">
            </div>
        </form>
    </div>
    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
        <li class="nav-item">
            <a href="<?php echo base_url('logout'); ?>" class="nav-link"><i class="fas fa-sign-out-alt"></i></a>
        </li>
    </ul>
</div>
</nav>
<!-- End Navbar -->