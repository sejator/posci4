<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">
    <button class="btn btn-primary mb-1 tambah"><i class="fas fa-plus"></i> Tambah Pemasok</button>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-pemasok" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pemasok</th>
                            <th>No. Telp</th>
                            <th>Alamat</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open(); ?>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="pemasok" class="col-sm-3 col-form-label">Nama Pemasok</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="pemasok" name="pemasok" placeholder="Nama Pemasok">
                            <small class="invalid-feedback"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telp" class="col-sm-3 col-form-label">No Telp</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="telp" name="telp" placeholder="No telp">
                            <small class="invalid-feedback"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea name="alamat" id="alamat" class="form-control"></textarea>
                            <small class="invalid-feedback"></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                            <small class="invalid-feedback"></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" id="" class="btn btn-primary">Simpan</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div><!-- /.container-fluid -->
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    $(document).ready(function() {
        let table = $("#table-pemasok").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: `${BASE_URL}/pemasok/ajax`
            },
            columns: [{
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'pemasok',
                    name: 'pemasok'
                },
                {
                    data: 'telp',
                    name: 'telp'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: function(row) {
                        let button = '<button class="btn btn-success btn-sm mr-1 edit" data-id="' + row.id + '" data-pemasok="' + row.pemasok + '" data-telp="' + row.telp + '" data-alamat="' + row.alamat + '" data-keterangan="' + row.keterangan + '"><i class="fas fa-edit"></i></button>';
                        button += '<button class="btn btn-danger btn-sm hapus" data-id="' + row.id + '"><i class="fas fa-trash"></i></button>';
                        return button;
                    }
                }
            ]
        })
        // tombol tambah 
        $(".tambah").on("click", function() {
            $("#formModal").modal("show")
            $(".modal-title").text("Tambah Data")
            $("button[type=submit]").attr("id", "tambah")
        })
        // tombol simpan di modal
        $('.content').on('click', '#tambah', function(e) {
            e.preventDefault();
            $.ajax({
                type: $("form").attr("method"),
                url: `${BASE_URL}/pemasok/tambah`,
                dataType: "json",
                data: $("form").serialize(),
                success: function(response) {
                    responValidasi(['tambah'], ['pemasok', 'telp', 'alamat'], response);
                    if (response.sukses) {
                        $('#formModal').modal('hide');
                        table.ajax.reload()
                    }
                }
            })
        })
        // tombol edit
        $('.content').on('click', '.edit', function(e) {
            e.preventDefault();
            $('#formModal').modal('show');
            $('.modal-title').text('Edit Data');
            $('button[type=submit]').attr('id', 'ubah')

            $('#pemasok').val($(this).data('pemasok'));
            $('#telp').val($(this).data('telp'));
            $('#alamat').val($(this).data('alamat'));
            $('#keterangan').val($(this).data('keterangan'));
            $('.modal-footer').append('<input type="hidden" name="id" value="' + $(this).data('id') + '">');
        })
        $('.content').on('click', '#ubah', function(e) {
            e.preventDefault()
            $.ajax({
                type: $("form").attr("method"),
                url: `${BASE_URL}/pemasok/ubah`,
                dataType: "json",
                data: $("form").serialize(),
                success: function(response) {
                    responValidasi(['ubah'], ['pemasok', 'telp', 'alamat'], response);
                    if (response.sukses) {
                        $('#formModal').modal('hide');
                        table.ajax.reload()
                    }
                }
            })
        })
        // tombol hapus 
        $('.content').on('click', '.hapus', function(e) {
            e.preventDefault()
            Swal.fire({
                title: 'Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Konfirmasi!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${BASE_URL}/pemasok/hapus`,
                        data: {
                            id: $(this).data('id')
                        },
                        success: function(response) {
                            table.ajax.reload()
                            if (response.status) {
                                toastr.success(response.pesan, 'Sukses')
                            } else {
                                toastr.error(response.pesan, 'Gagal')
                            }
                        }
                    })
                }
            })
        })
        // form modal hide
        $('#formModal').on('hidden.bs.modal', function() {
            $('form')[0].reset();
            $('input').removeClass('is-invalid');
            $('textarea').removeClass('is-invalid');
            $('input[name=id]').remove();
        })
    });
</script>
<?= $this->endSection(); ?>