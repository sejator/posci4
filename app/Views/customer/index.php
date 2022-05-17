<?php $this->extend('layout/template'); ?>
<?php $this->section('content'); ?>

<div class="container-fluid">
    <button class="btn btn-primary mb-1 tambah"><i class="fas fa-plus"></i> Tambah Customer</button>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <?= csrf_field('token'); ?>
                <table class="table table-bordered table-striped" id="tableCustomer" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Customer</th>
                            <th>Jenis Kelamin</th>
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
<div class="modal fade" id="formModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-3 col-form-label">
                            <label for="customer">Nama</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="customer" id="customer" placeholder="Nama customer..">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3 col-form-label">
                            <label for="kelamin">Jenis Kelamin</label>
                        </div>
                        <div class="col-sm-9">
                            <select name="kelamin" id="kelamin" class="form-control">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        let csrfName = $("#token").attr("name");
        let csrfHash = $("#token").val();
        const table = $("#tableCustomer").DataTable({
            'processing': true,
            'serverSide': true,
            'ajax': {
                'url': url + "/customer/data",
                'type': 'post',
                'data': function(d) {
                    d[csrfName] = csrfHash // kirim token
                }
            },
            'lengthMenu': [
                [5, 10, 50, 100],
                [5, 10, 50, 100]
            ], //Combobox Limit
            'columns': [{
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    'data': 'customer'
                },
                {
                    'data': 'kelamin'
                },
                {
                    'data': 'telp'
                },
                {
                    'data': 'alamat'
                },
                {
                    render: function(data, type, row) {
                        let html = '<button class="btn btn-success btn-sm mr-1 edit" data-id="' + row.id + '" data-customer="' + row.customer + '" data-kelamin="' + row.kelamin + '" data-telp="' + row.telp + '" data-alamat="' + row.alamat + '"><i class="fas fa-edit"></i></button>';
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
        table.on('xhr.dt', function(data, row, json) {
            csrfHash = json.token // update token
        })
        // tombol tambah
        $('.tambah').on('click', function() {
            $('#formModal').modal('show');
            $('form').attr('action', url + '/customer');
            $('.modal-title').text('Tambah Data Customer');
            $('button[type=submit]').attr('id', 'tambah').text('Save');
        })
        // tombol simpan
        $('.content').on('click', '#tambah', function(e) {
            e.preventDefault()
            $.ajax({
                type: $("form").attr("method"),
                url: $('form').attr('action'),
                dataType: "json",
                data: {
                    [csrfName]: csrfHash,
                    customer: $('#customer').val(),
                    kelamin: $('#kelamin').val(),
                    telp: $('#telp').val(),
                    alamat: $('#alamat').val()
                },
                success: function(response) {
                    csrfHash = response.token // update token
                    if (response.success === false) {
                        (response.pesan.customer) ? $('#customer').addClass('is-invalid').next().text(response.pesan.customer): $('#customer').removeClass('is-invalid');
                    } else {
                        // validation sukse
                        $('#formModal').modal('hide')
                        toastr.success('', 'Data berhasil ditambah!');
                        // Swal.fire({
                        //     title: 'Data berhasil ditambah!',
                        //     icon: 'success',
                        //     showConfirmButton: false,
                        //     timer: 1500
                        // })
                        table.ajax.reload()
                    }
                }
            });
        })
        $(".content").on("click", ".edit", function() {
            $("#formModal").modal('show');
            $(".modal-title").text('Edit Data Customer');
            $("form").attr("action", url + "/customer/edit");

            $("#customer").val($(this).data("customer"));
            $("#kelamin").val($(this).data("kelamin"));
            $("#telp").val($(this).data("telp"));
            $("#alamat").val($(this).data("alamat"));
            $("button[type=submit]").attr("id", "update").text("Update");
            $(".modal-footer").append('<input type="hidden" name="id" value="' + $(this).data("id") + '">');
        })
        // button update
        $(".content").on("click", "#update", function(e) {
            e.preventDefault();
            $.ajax({
                type: $("form").attr("method"),
                url: $("form").attr("action"),
                dataType: "json",
                data: {
                    [csrfName]: csrfHash,
                    customer: $('#customer').val(),
                    kelamin: $('#kelamin').val(),
                    telp: $('#telp').val(),
                    alamat: $('#alamat').val(),
                    id: $("input[name=id]").val()
                },
                success: function(response) {
                    csrfHash = response.token // update token
                    if (response.success === false) {
                        (response.pesan.customer) ? $('#customer').addClass('is-invalid').next().text(response.pesan.customer): $('#customer').removeClass('is-invalid');
                    } else {
                        // validation sukse
                        $('#formModal').modal('hide')
                        toastr.success('', 'Data berhasil diupdate!');
                        // Swal.fire({
                        //     title: 'Data berhasil diupdate!',
                        //     icon: 'success',
                        //     showConfirmButton: false,
                        //     timer: 1500
                        // })
                        table.ajax.reload()
                    }
                }
            });
        })
        $('#formModal').on('hide.bs.modal', function() {
            $('form')[0].reset();
            $('input').removeClass('is-invalid');
            $('#alamat').removeClass('is-invalid');
            $("input[name=id]").remove();
        })
        $('.content').on('click', '.hapus', function(e) {
            Swal.fire({
                title: 'Yakin ingin menghapus data ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: url + "/customer/hapus",
                        dataType: "json",
                        data: {
                            [csrfName]: csrfHash,
                            id: $(this).data('id')
                        },
                        success: function(response) {
                            csrfHash = response.token // update token
                            toastr.success('', 'Data berhasil dihapus!');
                            // Swal.fire({
                            //     title: 'Data berhasil dihapus!',
                            //     icon: 'success',
                            //     showConfirmButton: false,
                            //     timer: 1500
                            // })
                            table.ajax.reload()
                        }
                    })
                }
            })
        })
    });
</script>

<?php $this->endSection(); ?>