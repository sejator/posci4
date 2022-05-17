<?php $this->extend('layout/template'); ?>
<?php $this->section('content'); ?>

<div class="container-fluid">
    <button class="btn btn-primary mb-1 tambah"><i class="fas fa-plus"></i> Tambah Pelanggan</button>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <?= csrf_field('token'); ?>
                <table class="table table-bordered table-striped" id="table-pelanggan" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pelanggan</th>
                            <th>Jenkel</th>
                            <th>No. Telp</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
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
            <?= form_open() ?>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-3 col-form-label">
                        <label for="pelanggan">Nama</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="pelanggan" id="pelanggan" placeholder="Nama pelanggan..">
                        <small class="invalid-feedback"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3 col-form-label">
                        <label for="jenkel">Jenis jenkel</label>
                    </div>
                    <div class="col-sm-9">
                        <select name="jenkel" id="jenkel" class="form-control">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki - Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3 col-form-label">
                        <label for="telp">No. Telp</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="telp" id="telp" placeholder="No. telp">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3 col-form-label">
                        <label for="alamat">Alamat</label>
                    </div>
                    <div class="col-sm-9">
                        <textarea name="alamat" id="alamat" class="form-control"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                <button type="submit" id="" class="btn btn-primary">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    $(document).ready(function() {
        const table = $("#table-pelanggan").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: `${BASE_URL}/pelanggan/ajax`
            },
            lengthMenu: [
                [5, 10, 50, 100],
                [5, 10, 50, 100]
            ], //Combobox Limit
            columns: [{
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'pelanggan',
                    name: 'pelanggan'
                },
                {
                    data: 'jenkel',
                    name: 'jenkel'
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
                    data: function(row) {
                        let html = '<button class="btn btn-success btn-sm mr-1 edit" data-id="' + row.id + '" data-pelanggan="' + row.pelanggan + '" data-jenkel="' + row.jenkel + '" data-telp="' + row.telp + '" data-alamat="' + row.alamat + '"><i class="fas fa-edit"></i></button>';
                        html += '<button class="btn btn-danger btn-sm hapus" data-id="' + row.id + '"><i class="fa fa-trash"></i></button>'
                        return html;
                    }
                }
            ],
            "columnDefs": [{
                targets: 0,
                width: "5%",
            }, {
                targets: [2, 3, 4, 5],
                orderable: false
            }]
        })
        // tombol tambah
        $('.tambah').on('click', function() {
            $('#formModal').modal('show');
            $('form').attr('action', `${BASE_URL}/pelanggan/tambah`);
            $('.modal-title').text('Tambah Data');
            $('button[type=submit]').attr('id', 'tambah');
        })
        // tombol simpan
        $('.content').on('click', '#tambah', function(e) {
            e.preventDefault()
            $.ajax({
                type: $("form").attr("method"),
                url: $('form').attr('action'),
                dataType: "json",
                data: $("form").serialize(),
                success: function(response) {
                    responValidasi(['tambah'], ['pelanggan'], response);
                    if (response.sukses) {
                        $('#formModal').modal('hide')
                        table.ajax.reload()
                    }
                }
            });
        })
        $(".content").on("click", ".edit", function() {
            $("#formModal").modal('show');
            $(".modal-title").text('Edit Data');
            $("form").attr("action", `${BASE_URL}/pelanggan/ubah`);

            $("#pelanggan").val($(this).data("pelanggan"));
            $("#jenkel").val($(this).data("jenkel"));
            $("#telp").val($(this).data("telp"));
            $("#alamat").val($(this).data("alamat"));
            $("button[type=submit]").attr("id", "ubah");
            $(".modal-footer").append('<input type="hidden" name="id" value="' + $(this).data("id") + '">');
        })
        // button ubah
        $(".content").on("click", "#ubah", function(e) {
            e.preventDefault();
            $.ajax({
                type: $("form").attr("method"),
                url: $("form").attr("action"),
                dataType: "json",
                data: $("form").serialize(),
                success: function(response) {
                    responValidasi(['ubah'], ['pelanggan'], response);
                    if (response.sukses) {
                        $('#formModal').modal('hide')
                        table.ajax.reload()
                    }
                }
            });
        })
        $('#formModal').on('hide.bs.modal', function() {
            $('form')[0].reset();
            $('input').removeClass('is-invalid');
            $("input[name=id]").remove();
        })
        $('.content').on('click', '.hapus', function(e) {
            Swal.fire({
                title: 'Yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Konfirmasi!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${BASE_URL}/pelanggan/hapus`,
                        data: {
                            id: $(this).data('id')
                        },
                        success: function(response) {
                            table.ajax.reload()
                            if (response.status) {
                                toastr.success(response.pesan, 'Sukses');
                            } else {
                                toastr.error(response.pesan, 'Gagal');
                            }
                        }
                    })
                }
            })
        })
    });
</script>
<?php $this->endSection(); ?>