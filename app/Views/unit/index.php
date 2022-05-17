<?php $this->extend('layout/template'); ?>
<?php $this->section('content'); ?>

<div class="container-fluid">
    <button class="btn btn-primary mb-1 tambah"><i class="fas fa-plus"></i> Tambah Unit</button>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="table-unit" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Unit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <?= form_open(); ?>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="unit" class="col-sm-2 col-form-label">Unit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="unit" id="unit" placeholder="Unit...">
                        <small class="invalid-feedback"></small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary" id="">Simpan</button>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    $(document).ready(function() {
        const table = $("#table-unit").DataTable({
            proseccing: true,
            serverSide: true,
            ajax: {
                url: `${BASE_URL}/unit/ajax`
            },
            lengthMenu: [
                [5, 10, 50],
                [5, 10, 50]
            ],
            columns: [{
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'unit',
                    name: 'unit'
                },
                {
                    data: function(row) {
                        let html = '<button class="btn btn-success btn-sm mr-1 edit" data-id="' + row.id + '" data-unit="' + row.unit + '"><i class="fas fa-edit"></i></button>';
                        html += '<button class="btn btn-danger btn-sm hapus" data-id="' + row.id + '"><i class="fa fa-trash"></i></button>'
                        return html;
                    }
                }
            ],
            columnDefs: [{
                targets: 0,
                width: "5%",
            }, {
                targets: 2,
                orderable: false
            }]
        });

        $(".tambah").on("click", function() {
            $("#formModal").modal("show");
            $(".modal-title").text("Tambah Data");
            $("button[type=submit]").attr("id", "tambah");
        });
        $(".content").on("click", "#tambah", function(e) {
            e.preventDefault();
            $.ajax({
                type: $("form").attr("method"),
                url: `${BASE_URL}/unit/tambah`,
                dataType: "json",
                data: $("form").serialize(),
                success: function(response) {
                    responValidasi(['tambah'], ['unit'], response);
                    if (response.sukses) {
                        $("#formModal").modal("hide");
                        table.ajax.reload()
                    }
                }
            });
        })
        $(".content").on("click", ".edit", function() {
            $("#formModal").modal("show");
            $(".modal-title").text("Edit Data");
            $("button[type=submit]").attr("id", "ubah");
            $("#unit").val($(this).data("unit"));
            $(".modal-footer").append('<input type="hidden" name="id" value="' + $(this).data("id") + '">');
        })
        $(".content").on("click", "#ubah", function(e) {
            e.preventDefault();
            $.ajax({
                type: $("form").attr("method"),
                url: `${BASE_URL}/unit/ubah`,
                dataType: "json",
                data: $("form").serialize(),
                success: function(response) {
                    responValidasi(['ubah'], ['unit'], response);
                    if (response.sukses) {
                        $("#formModal").modal("hide");
                        table.ajax.reload()
                    }
                }
            });
        })
        $(".content").on("click", ".hapus", function() {
            Swal.fire({
                title: 'Yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Konfirmasi!',
                cancelButtonText: 'Batal'
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${BASE_URL}/unit/hapus`,
                        data: {
                            id: $(this).data("id")
                        },
                        success: function(response) {
                            table.ajax.reload() // reload table
                            if (response.status) {
                                toastr.success(response.pesan, 'Sukses')
                            } else {
                                toastr.error(response.pesan, 'Gagal')
                            }
                        }
                    });
                }
            })
        })
        $("#formModal").on("hide.bs.modal", function() {
            $("form")[0].reset();
            $("#unit").removeClass("is-invalid");
            $("input[name=id]").remove();
        })
    });
</script>
<?php $this->endSection(); ?>