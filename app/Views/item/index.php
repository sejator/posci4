<?php $this->extend('layout/template'); ?>
<?php $this->section('content'); ?>

<div class="container-fluid">
    <button class="btn btn-primary mb-1 tambah"><i class="fas fa-plus"></i> Tambah Item</button>
    <button class="btn btn-success mb-1 export-excel"><i class="fas fa-file-excel"></i> Export</button>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="table-item" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Barcode</th>
                            <th>Item</th>
                            <th>Harga</th>
                            <th>Stok</th>
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
        <?= form_open_multipart('', ['csrf_id' => 'token']); ?>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="barcode">Barcode</label>
                        <input type="text" class="form-control" name="barcode" id="barcode">
                        <small class="invalid-feedback"></small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="item">Item</label>
                        <input type="text" class="form-control" name="item" id="item">
                        <small class="invalid-feedback"></small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control">
                            <option value="">Pilih Kategori</option>
                            <?php foreach (esc($kategori) as $data) : ?>
                                <option value="<?= esc($data->id) ?>"><?= esc($data->kategori)  ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="invalid-feedback"></small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="unit">Unit</label>
                        <select name="unit" id="unit" class="form-control">
                            <option value="">Pilih Unit</option>
                            <?php foreach (esc($unit) as $data) : ?>
                                <option value="<?= esc($data->id) ?>"><?= esc($data->unit)  ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="invalid-feedback"></small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="pemasok">Pemasok</label>
                        <select name="pemasok" id="pemasok" class="form-control">
                            <option value="">Pilih Pemasok</option>
                            <?php foreach (esc($pemasok) as $data) : ?>
                                <option value="<?= esc($data->id) ?>"><?= esc($data->pemasok)  ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="invalid-feedback"></small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" name="harga" id="harga">
                        <small class="invalid-feedback"></small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="text" class="form-control" name="stok" id="stok">
                        <small class="invalid-feedback"></small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="gambar" name="gambar">
                            <label class="custom-file-label" for="gambar">Upload gambar</label>
                            <small class="invalid-feedback"></small>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group d-none">
                        <img class="img-thumbnail" id="img-preview">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="gambarLama" id="gambarLama">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>
<!-- Modal detail -->
<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="detail-produk">Sedang memuat...</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
    $(document).ready(function() {
        const table = $("#table-item").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: `${BASE_URL}/item/ajax`
            },
            //optional
            lengthMenu: [
                [5, 10, 50, 100],
                [5, 10, 50, 100]
            ],
            columns: [{
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'barcode',
                    name: 'barcode'
                },
                {
                    data: 'item',
                    name: 'item'
                },
                {
                    data: 'harga',
                    name: 'harga'
                },
                {
                    data: 'stok',
                    name: 'stok'
                },
                {
                    data: function(row) {
                        let html = '<button class="btn btn-primary btn-sm mr-1 detail" data-barcode="' + row.barcode + '"><i class="fa fa-eye"></i></button>';
                        html += '<button class="btn btn-success btn-sm mr-1 ubah" data-id="' + row.iditem + '" data-barcode="' + row.barcode + '" data-item="' + row.item + '" data-kategori="' + row.idkategori + '" data-unit="' + row.idunit + '" data-pemasok="' + row.id_pemasok + '" data-harga="' + row.harga + '" data-stok="' + row.stok + '" data-gambar="' + row.gambar + '"><i class="fas fa-edit"></i></button>';
                        html += '<button class="btn btn-danger btn-sm hapus" data-id="' + row.iditem + '"><i class="fa fa-trash"></i></button>'
                        return html;
                    }
                }
            ],
            columnDefs: [{
                    targets: 0,
                    width: "5%"
                },
                {
                    targets: 5,
                    orderable: false
                }
            ]
        });

        $(".content").on("click", ".detail", function() {
            $("#modal-detail").modal("show")
            $.ajax({
                url: `${BASE_URL}/item/detail`,
                type: "post",
                data: {
                    [$("#token").attr('name')]: $("#token").val(),
                    barcode: $(this).data('barcode')
                },
                success: function(response) {
                    let detail = `<div class="row">
                        <div class="col-md-6 table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Bacode</th>
                                    <th>${response.barcode}</th>
                                </tr>
                                <tr>
                                    <th>Item</th>
                                    <th>${response.item}</th>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <th>${response.kategori}</th>
                                </tr>
                                <tr>
                                    <th>Unit</th>
                                    <th>${response.unit}</th>
                                </tr>
                                <tr>
                                    <th>Harga</th>
                                    <th>${response.harga}</th>
                                </tr>
                                <tr>
                                    <th>Stok</th>
                                    <th>${response.stok}</th>
                                </tr>
                                <tr>
                                    <th>Pemasok</th>
                                    <th>${response.pemasok}</th>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <img class="img-thumbnail" src="${BASE_URL}/uploads/produk/${response.gambar}">
                        </div>
                    </div>`;
                    $("#detail-produk").html(detail)
                }
            });
        })
        $("#modal-detail").on("hide.bs.modal", function() {
            $("#detail-produk").html('Sedang memuat...')
        })

        $(".tambah").on("click", function() {
            $("#formModal").modal("show");
            $(".modal-title").text("Tambah Data");
            $("button[type=submit]").attr("id", "tambah");
        })
        $("#gambar").on("change", function() {
            let src = URL.createObjectURL(event.target.files[0]);
            $("#img-preview").prop("src", src).parent().removeClass("d-none")
        })
        $(".content").on("click", "#tambah", function(e) {
            e.preventDefault();
            let formData = new FormData($("form")[0]);
            $.ajax({
                type: "post",
                url: `${BASE_URL}/item/tambah`,
                dataType: "json",
                contentType: false,
                processData: false,
                cache: false,
                data: formData,
                success: function(response) {
                    responValidasi(['tambah'], ['barcode', 'item', 'kategori', 'unit', 'pemasok', 'harga', 'stok'], response);
                    if (response.sukses) {
                        $("#formModal").modal("hide");
                        table.ajax.reload();
                    }
                }
            });
        })

        $(".content").on("click", ".ubah", function() {
            $("#formModal").modal("show");
            $(".modal-title").text("Edit Data");
            $("button[type=submit]").attr("id", "ubah");
            // isi tiap kolom
            $("#barcode").val($(this).data("barcode"));
            $("#item").val($(this).data("item"));
            $("#kategori").val($(this).data("kategori"));
            $("#unit").val($(this).data("unit"));
            $("#pemasok").val($(this).data("pemasok"));
            $("#harga").val($(this).data("harga"));
            $("#stok").val($(this).data("stok"));
            $("#img-preview").prop("src", `${BASE_URL}/uploads/produk/` + $(this).data('gambar')).parent().removeClass("d-none");
            $("#gambarLama").val($(this).data('gambar'));
            $(".modal-footer").append('<input type="hidden" name="id" value="' + $(this).data("id") + '">');
        })

        $(".content").on("click", "#ubah", function(e) {
            e.preventDefault();
            let formData = new FormData($("form")[0]);
            $.ajax({
                type: "post",
                url: `${BASE_URL}/item/ubah`,
                dataType: "json",
                contentType: false,
                processData: false,
                cache: false,
                data: formData,
                success: function(response) {
                    responValidasi(['ubah'], ['barcode', 'item', 'kategori', 'unit', 'pemasok', 'harga', 'stok'], response);
                    if (response.sukses) {
                        $("#formModal").modal("hide");
                        table.ajax.reload();
                    }
                }
            });
        })
        $("#formModal").on("hide.bs.modal", function() {
            $("form")[0].reset();
            $("input[name=id]").remove();
            $("input").removeClass("is-invalid");
            $("select").removeClass("is-invalid");
            $("#img-preview").parent().addClass("d-none");
        })

        $(".content").on("click", ".hapus", function() {
            Swal.fire({
                title: 'Yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${BASE_URL}/item/hapus`,
                        data: {
                            id: $(this).data('id')
                        },
                        success: function(response) {
                            table.ajax.reload()
                            if (response.status) {
                                toastr.success(response.pesan, 'Sukses');
                            } else {
                                toastr.error(response.pesan, 'Gagal')
                            }
                        }
                    });
                }
            })
        })
        $(".export-excel").on("click", function() {
            location.href = `${BASE_URL}/item/download`
        })
    });
</script>
<?php $this->endSection(); ?>