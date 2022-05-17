<!DOCTYPE html>
<html lang="en">
<?= $this->include('layout/header'); ?>
<!-- render Head disini -->
<?= $this->renderSection('header') ?>
<!-- Head -->

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
    <div class="preloader">
        <div class="loading">
            <div class="spinner-grow text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
    <div id="base-url" data-url="<?= base_url(); ?>"></div>
    <div class=" wrapper">
        <!-- Navbar -->
        <?= $this->include('layout/navbar'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->include('layout/sidebar'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= esc($title); ?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                                <li class="breadcrumb-item active"><?= ucfirst(uri_string()) ?></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <?= $this->renderSection('content'); ?>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <div class="modal fade" id="modal-logout">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Informasi!!</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah yakin ingin keluar ?</p>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Keluar</a>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                <span>{elapsed_time} detik</span> |
                <span>Dev : <a href="<?= esc(WA_DEV) ?>" target="blank" rel="nofollow"><?= esc(APP_DEV) ?></a></span> |
                <span>Versi : <?= esc(APP_VER) ?></span>
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2021 - <?= date('Y') ?> <a href="<?= base_url() ?>"><?= get_pengaturan('nama_toko'); ?></a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->
    <?= $this->include('layout/js'); ?>
    <!-- render Javascript disini -->
    <?= $this->renderSection('js'); ?>
    <!-- Javascript -->
</body>

</html>