<?=$this->extend('layout/template');?>
<?=$this->section('content');?>

<div class="container-fluid">
    <button class="btn btn-primary mb-1" id="tambah"><i class="fas fa-plus"></i> Tambah Stok Keluar</button>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="tabel-stok" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Barcode</th>
                            <th>Item</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal stok masuk -->
<div class="modal fade" id="modalStokKeluar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Stok Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?=form_open('', ['csrf_id' => 'token']);?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="tanggal">Tanggal</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?=esc(date('Y-m-d'))?>">
                        <small class="invalid-feedback"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <input type="hidden" id="iditem" name="iditem">
                    <input type="hidden" name="tipe" value="keluar">
                    <label for="barcode" class="col-sm-3 col-form-label">Barcode</label>
                    <div class="col-sm-9">
                        <select name="barcode" id="barcode" class="form-control"></select>
                        <small class="invalid-feedback"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="item" class="col-sm-3 col-form-label">Nama Item</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="item" name="item" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="unit" class="col-sm-3 col-form-label">Item Unit</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="unit" name="unit" disabled value="-">
                    </div>
                    <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="stok" name="stok" disabled value="-">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="pemasok" class="col-sm-3 col-form-label">Pemasok</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="pemasok" id="pemasok" disabled>
                            <option value="">- Pilih Pemasok -</option>
                            <?php foreach (esc($pemasok) as $data): ?>
                                <option value="<?=esc($data->id)?>"><?=esc($data->pemasok);?></option>
                            <?php endforeach;?>
                        </select>
                        <small class="invalid-feedback"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jumlah" class="col-sm-3 col-form-label">Jumlah</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="jumlah" name="jumlah">
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
                <div class="form-group float-right">
                    <button type="submit" id="simpan" class="btn btn-primary">Simpan</button>
                </div>
                <!-- /.card-body -->
                <?=form_close();?>
            </div>
        </div>
    </div>
</div>

<!-- Modal detail -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Stok Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <div id="detail"></div>
            </div>
        </div>
    </div>
</div>

<?=$this->endSection();?>

<?=$this->section('js');?>
<script>
    $(document).ready(function() {
        const table = $("#tabel-stok").DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                url: `${BASE_URL}/transaksi/stok`,
                data: function(d) {
                    d.tipe = 'keluar'
                }
            },
            lengthMenu: [
                [5, 10],
                [5, 10]
            ],
            columns: [{
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'barcode'
                },
                {
                    data: 'item'
                },
                {
                    data: 'jumlah'
                },
                {
                    data: 'tanggal'
                },
                {
                    render: function(data, type, row) {
                        let html = '<button class="btn btn-primary btn-sm mr-1 detail" data-barcode="' + row.barcode + '" data-item="' + row.item + '" data-jumlah="' + row.jumlah + '" data-pemasok="' + row.pemasok + '" data-keterangan="' + row.keterangan + '" data-tanggal="' + row.tanggal + '"><i class="fas fa-eye"></i></button>';
                        html += '<button class="btn btn-danger btn-sm hapus" data-id="' + row.id + '"><i class="fa fa-trash"></i></button>'
                        return html;
                    }
                }
            ],
            columnDefs: [{
                targets: 0,
                width: "5%",
            }, {
                targets: [0, 3, -1],
                orderable: false
            }]
        })

        $('#tambah').on('click', function() {
            $('#modalStokKeluar').modal('show')
        })

        $("#barcode").select2({
            dropdownParent: $('#modalStokKeluar'),
            placeholder: 'Cari nama / barcode produk',
            allowClear: true,
            maximumInputLength: 3,
            ajax: {
                url: `${BASE_URL}/item/cariProduk`,
                dataType: 'json',
                data: function(params) {
                    var query = {
                        search: params.term,
                        page: params.page || 1
                    }
                    return query;
                }
            }
        })

        $("#barcode").on('change', function(e) {
            $.ajax({
                url: `${BASE_URL}/item/detail`,
                type: 'get',
                data: {
                    barcode: e.target.value
                },
                success: function(response) {
                    $("#iditem").val(response.iditem)
                    $("#barcode").val(response.barcode)
                    $("#item").val(response.item)
                    $("#unit").val(response.unit)
                    $("#stok").val(response.stok)
                    $("#pemasok").val(response.id_pemasok).prop("disabled", false)
                }
            });
        })

        $("#simpan").on("click", function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: `${BASE_URL}/transaksi/proses`,
                dataType: "json",
                data: $("form").serialize(),
                success: function(response) {
                    responValidasi(['simpan'], ['tanggal', 'barcode', 'pemasok', 'jumlah', 'keterangan'], response);
                    if (response.sukses) {
                        $('#modalStokKeluar').modal('hide')
                        $("form").trigger('reset')
                        $("#barcode").val('').trigger('change')
                        table.ajax.reload()
                    }
                }
            });
        })

        $(".content").on("click", ".detail", function() {
            $("#detailModal").modal("show");
            let konten = `<table class="table table-bordered">
                    <tr>
                        <th>Barcode</th>
                        <td>${$(this).data("barcode")}</td>
                    </tr>
                    <tr>
                        <th>Item Produk</th>
                        <td>${$(this).data("item")}</td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>${$(this).data("jumlah")}</td>
                    </tr>
                    <tr>
                        <th>Pemasok</th>
                        <td>${$(this).data("pemasok")}</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>${$(this).data("keterangan")}</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>${$(this).data("tanggal")}</td>
                    </tr>
                </table>`
            $("#detail").html(konten)
        })

        $(".content").on("click", ".hapus", function() {
            Swal.fire({
                title: 'Yakin ingin menghapus data ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal!'
            }).then(result => {
                if (result.isConfirmed) {
                    // ajax hapus data
                    $.ajax({
                        url: `${BASE_URL}/transaksi/hapus`,
                        data: {
                            id: $(this).data('id'),
                            tipe: 'keluar'
                        },
                        success: function(response) {
                            if (response.status) {
                                table.ajax.reload()
                                toastr.success(response.pesan)
                            } else {
                                toastr.error(response.pesan)
                            }
                        }
                    });
                }
            })
        })
    })
</script>

<?php $this->endSection();?>