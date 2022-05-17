<?= $this->extend('auth/auth_template'); ?>
<?= $this->section('auth'); ?>

<div class="login-logo">
    <a href="javascript:void(0)"><b><?= esc($title); ?></b></a>
</div>
<!-- /.login-logo -->
<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Silahkan masukkan email yang terdaftar untuk mengubah password.</p>
        <?= form_open(); ?>
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="email" name="email" placeholder="Email" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            <small class="invalid-feedback"></small>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block" id="lupa">Kirim Link</button>
            </div>
            <!-- /.col -->
        </div>
        <?= form_close(); ?>
        <hr>
        <a href="<?= base_url('auth') ?>">Login</a>
    </div>
    <!-- /.login-card-body -->
</div>

<?= $this->endSection(); ?>