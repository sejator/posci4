<?=$this->extend('layout/template');?>
<?=$this->section('content');?>
<style>
    div.dataTables_wrapper div.dataTables_length label {
        display: none !important;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="form-group row d-none">
                        <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?=date('Y-m-d')?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="user" class="col-sm-3 col-form-label">Kasir</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="user" id="user" readonly value="<?=get_user('nama')?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pelanggan" class="col-sm-3 col-form-label">Pelanggan</label>
                        <div class="col-sm-9">
                            <select name="pelanggan" id="pelanggan" class="form-control">
                                <?php foreach (esc($pelanggan) as $data): ?>
                                    <option value="<?=esc($data->id)?>"><?=esc($data->pelanggan);?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="barcode" class="col-sm-3 col-form-label">Barcode</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="hidden" id="iditem">
                                <input type="hidden" id="nama">
                                <input type="hidden" id="harga">
                                <input type="hidden" id="stok">
                                <input type="text" class="form-control mr-2" id="barcode" name="barcode" placeholder="Input barcode" autofocus autocomplete="off">
                                <span class="text-muted" id="tampil-stok"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah" class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm-5">
                            <input type="number" class="form-control" name="jumlah" id="jumlah" min="1" disabled>
                        </div>
                        <div class="col-sm-4">
                            <button type="button" id="tambah" class="btn btn-primary" disabled>Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="text-right">
                        <h4>Invoice : <span class="text-bold" id="invoice"></span></h4>
                        <h1><span class="text-bold text-danger" id="tampilkan_total">0</span></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="p-0 table-responsive">
                    <table class="table table-bordered table-striped" id="tabel-keranjang" width="100%">
                        <thead>
                            <tr>
                                <th>Barcode</th>
                                <th>Nama Item</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th style="width: 150px;">Diskon item (%)</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- .row -->
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="sub_total" class="col-sm-5 col-form-label">Sub Total</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control text-right" name="sub_total" id="sub_total" value="0" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="diskon" class="col-sm-5 col-form-label">Dis Total (%)</label>
                        <div class="col-sm-7">
                            <input type="number" class="form-control text-right" name="diskon" id="diskon" autocomplete="off" value="0" min="0" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="total_akhir" class="col-sm-5 col-form-label">Total Akhir</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control text-right" name="total_akhir" id="total_akhir" value="0" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .col-md-3 -->
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="tunai" class="col-sm-5 col-form-label">Tunai</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control text-right" name="tunai" id="tunai" value="0" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kembalian" class="col-sm-5 col-form-label">Kembalian</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control text-right" name="kembalian" id="kembalian" value="0" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .col-md-3 -->
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea class="form-control" name="catatan" id="catatan" rows="3" disabled></textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- .col-md-3 -->
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <p><button class="btn btn-warning" id="batal" disabled><i class="fa fa-refresh"></i> Batal</button></p>
                    <p><button class="btn btn-success" id="bayar" disabled><i class="fa fa-paper-plane"></i> Proses Pembayaran</button></p>
                </div>
            </div>
        </div>
        <!-- .col-md-3 -->
    </div>
    <!-- .row -->
</div>

<!-- modal edit item produk -->
<div class="modal fade" id="modal-item-edit" aria-modal="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <?=form_open('', ['csrf_id' => 'token']);?>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Item</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="item_id" name="item_id">
                <input type="hidden" id="item_stok" name="item_stok">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for=""> Barcode</label>
                        <input type="text" id="item_barcode" name="item_barcode" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Item Produk</label>
                        <input type="text" id="item_nama" name="item_nama" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="item_harga">Harga</label>
                        <input type="text" id="item_harga" name="item_harga" class="form-control" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="item_jumlah">Jumlah <small id="modal-stok" class="text-muted"></small></label>
                        <input type="number" id="item_jumlah" name="item_jumlah" class="form-control" min="1">
                    </div>
                </div>
                <div class="form-group">
                    <label for="harga_sebelum_diskon">Total sebelum Diskon</label>
                    <input type="text" id="harga_sebelum_diskon" name="harga_sebelum_diskon" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="item_diskon">Diskon Item (%)</label>
                    <input type="number" id="item_diskon" name="item_diskon" class="form-control" min="0">
                </div>
                <div class="form-group">
                    <label for="harga_setelah_diskon">Total setelah Diskon</label>
                    <input type="text" id="harga_setelah_diskon" name="harga_setelah_diskon" class="form-control" min="0" readonly>
                </div>
            </div>
            <div class="form-group">
                <div class="float-right mr-3">
                    <button type="button" class="btn btn-success" id="edit-keranjang"><i class="fa fa-paper-plane"></i> Simpan</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
        <?=form_close();?>
    </div>
    <!-- /.modal-dialog -->
</div>
<?=$this->endSection();?>

<?=$this->section('js');?>
<script src="<?=base_url('js/penjualan.js')?>"></script>
<script src="<?=base_url('plugins/jquery-ui/jquery-ui.min.js')?>"></script>
<script src="<?=base_url('plugins/autoNumeric.min.js')?>"></script>
<script>
    let auto_numeric = new AutoNumeric('#tunai', {
        decimalCharacter: ",",
        decimalPlaces: 0,
        digitGroupSeparator: ".",
    });
</script>
<?=$this->endSection();?>