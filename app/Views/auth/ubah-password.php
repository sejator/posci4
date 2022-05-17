<?= $this->extend('auth/auth_template'); ?>
<?= $this->section('auth'); ?>

<div class="login-logo">
    <a href="javascript:void(0)"><b><?= esc($title); ?></b></a>
</div>
<!-- /.login-logo -->
<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Silahkan ganti password anda.</p>
        <?= form_open('auth/ganti-password'); ?>
        <input type="hidden" name="kode" id="kode" value="<?= esc($token) ?>">
        <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password Baru" autocomplete="off">
            <div class="input-group-append show-password">
                <div class="input-group-text">
                    <span class="fas fa-eye-slash"></span>
                </div>
            </div>
            <small class="invalid-feedback"></small>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" placeholder="Konfirmasi Password" autocomplete="off">
            <div class="input-group-append show-password">
                <div class="input-group-text">
                    <span class="fas fa-eye-slash"></span>
                </div>
            </div>
            <small class="invalid-feedback"></small>
        </div>
        <div class="input-group">
            <button type="submit" class="btn btn-primary btn-block" id="ubah">Ubah Password</i></button>
        </div>
        <?= form_close(); ?>
        <hr>
        <a href="<?= base_url('auth') ?>">Login</a>
    </div>
    <!-- /.login-card-body -->
</div>

<?= $this->endSection(); ?>
<?= $this->section('js'); ?>
<script>
    let kode = $('#kode').val();
    if (kode == '') {
        $('input, button').prop('disabled', true);
        Swal.fire({
            title: 'Oops',
            text: 'Maaf token tidak valid, silahkan request ulang',
            icon: 'error'
        })
    }
</script>
<?= $this->endSection(); ?>