<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="img-fluid img-circle avatar" src="<?= base_url('uploads/profile/' . esc($user->avatar)) ?>">
                    </div>
                    <h3 class="profile-username text-center"></h3>
                    <p class="text-muted text-center">Tanggal Daftar : <?= esc(date('d M Y', strtotime($user->created_at))); ?></p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <?= form_open_multipart(base_url('/user/ubah'), ['csrf_id' => 'token']); ?>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" id="nama" value="<?= esc($user->nama) ?>">
                            <small class="invalid-feedback"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" id="username" value="<?= esc($user->username) ?>">
                            <small class="invalid-feedback"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Alamat Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" id="email" value="<?= esc($user->email) ?>">
                            <small class="invalid-feedback"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="password" autocomplete="off">
                            <small class="text-danger">Kosongkan jika tidak ingin di ganti!</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="alamat" id="alamat" class="form-control"><?= esc($user->alamat); ?></textarea>
                            <small class="invalid-feedback"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="avatar" class="col-sm-2 col-form-label">Photo Profile</label>
                        <div class="col-sm-2 d-none">
                            <img class="img-thumbnail" id="img-preview">
                        </div>
                        <div class="col-sm-4">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="avatar" name="avatar">
                                <label class="custom-file-label" for="avatar">Upload Photo</label>
                                <small class="invalid-feedback"></small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <input type="hidden" name="id" value="<?= esc($user->id); ?>">
                        <input type="hidden" name="role" value="<?= esc($user->id_role); ?>">
                        <input type="hidden" name="avatarLama" id="avatarLama" value="<?= esc($user->avatar); ?>">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" id="simpan" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                    <?= form_close(); ?>
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    $("#avatar").on("change", function(e) {
        let src = URL.createObjectURL(e.target.files[0]);
        $("#img-preview").prop("src", src).parent().removeClass("d-none")
    })
    $("#simpan").on("click", function(e) {
        e.preventDefault();
        let formData = new FormData($("form")[0]);
        $.ajax({
            type: $("form").attr("method"),
            url: $("form").attr("action"),
            dataType: "json",
            contentType: false,
            processData: false,
            cache: false,
            data: formData,
            success: function(response) {
                responValidasi(['simpan'], ['nama', 'username', 'email', 'avatar'], response);
                if (response.sukses) {
                    $("#img-preview").parent().addClass('d-none');
                    $(".avatar").attr("src", `${BASE_URL}/uploads/profile/${response.user.avatar}`);
                    $("#nama").val(response.user.nama);
                    $("#username").val(response.user.username);
                    $("#email").val(response.user.email);
                    $("#password").val('');
                    $("#alamat").val(response.user.alamat);
                    $("#avatarLama").val(response.user.avatar);
                }
            }
        });
    });
</script>

<?php $this->endSection(); ?>