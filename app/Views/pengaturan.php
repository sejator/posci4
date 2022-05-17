<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <?php if (!empty(session()->getFlashdata('pesan'))) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-body">
                    <?= form_open(); ?>
                    <div class="form-group">
                        <label>Nama Toko</label>
                        <input type="text" class="form-control" placeholder="Nama Toko" name="nama_toko" value="<?= $pengaturan['nama_toko'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>No Telp</label>
                        <input type="text" class="form-control" placeholder="No Telp" name="no_telp" value="<?= $pengaturan['no_telp'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" placeholder="Alamat" class="form-control" required><?= $pengaturan['alamat'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Simpan</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.container-fluid -->
<?= $this->endSection(); ?>