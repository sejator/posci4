<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=get_pengaturan('nama_toko');?> | Cetak Struk</title>
    <style>
        html {
            font-family: "Verdana, Arial";
            color: #333;
        }

        .container {
            width: 80mm;
            font-size: 12px;
            padding: 5px;
        }

        .title {
            text-align: center;
            font-size: 13px;
            padding-bottom: 5px;
            border-bottom: 1px dashed;
        }

        .title h2,
        p {
            margin-bottom: 0;
            margin-top: 0;
        }

        .head {
            margin-top: 5px;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid;
        }

        .table {
            width: 100%;
            font-size: 11px;
        }

        .kiri {
            text-align: left;
        }

        .kanan {
            text-align: right;
        }

        .terimakasih {
            margin-top: 10px;
            padding-top: 10px;
            text-align: center;
            border-top: 1px dashed;
        }

        @media print {
            @page {
                width: 80mm;
                margin: 0mm;
            }
        }
    </style>
</head>

<body onload="print()">
    <div class="container">
        <div class="title">
            <h2><?=get_pengaturan('nama_toko');?></h2>
            <p><?=get_pengaturan('alamat');?></p>
            <p><?=get_pengaturan('no_telp');?></p>
        </div>
        <div class="head">
            <table class="table">
                <tr>
                    <td class="kiri"><?=date("d F Y H:i", strtotime(esc($transaksi[0]['tanggal'])))?></td>
                    <td class="kanan"> Kasir :</td>
                    <td class="kanan"><?=esc($transaksi[0]['kasir']);?></td>
                </tr>
                <tr>
                    <td class="kiri"><?=esc($transaksi[0]['invoice']);?></td>
                    <td class="kanan">Pelanggan :</td>
                    <td class="kanan"><?=esc($transaksi[0]['pelanggan']);?></td>
                </tr>

            </table>
        </div>
        <div class="transaksi">
            <table class="table">
                <?php $diskon = 0;?>
                <?php foreach (esc($transaksi) as $data): ?>
                    <?php $diskon = esc($data['diskon']);?>
                    <tr>
                        <td class="kiri"><?=esc($data['item']);?></td>
                        <td class="kanan"><?=esc($data['jumlah']);?> x </td>
                        <td class="kanan"><?=rupiah(esc($data['harga']));?></td>
                        <?php if (esc($data['diskon_item']) != 0): ?>
                            <td class="kanan">Dis item <?=esc($data['diskon_item']);?> %</td>
                        <?php else: ?>
                            <td class="kanan"></td>
                        <?php endif;?>
                        <td class="kanan"><?=rupiah(esc($data['subtotal']));?></td>
                    </tr>
                <?php endforeach;?>
                <tr>
                    <td colspan="5" style="border-bottom:1px solid; "></td>
                </tr>
                <tr>
                    <td colspan="4" class="kanan">Sub Total</td>
                    <td class="kanan"><?=rupiah(esc($transaksi[0]['total_harga']));?></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="3" style="border-bottom: 1px dashed;"></td>
                </tr>
                <?php if (esc($diskon) != 0): ?>
                    <tr>
                        <td colspan="4" class="kanan">Diskon Pembelian</td>
                        <td class="kanan"><?=esc($diskon);?> %</td>
                    </tr>
                <?php endif;?>
                <tr>
                    <td colspan="4" class="kanan">Total Akhir</td>
                    <td class="kanan"><?=rupiah(esc($transaksi[0]['total_akhir']));?></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="3" style="border-bottom: 1px dashed;"></td>
                </tr>
                <tr>
                    <td colspan="4" class="kanan">Tunai</td>
                    <td class="kanan"><?=rupiah(esc($transaksi[0]['tunai']));?></td>
                </tr>
                <tr>
                    <td colspan="4" class="kanan">Kembalian</td>
                    <td class="kanan"><?=rupiah(esc($transaksi[0]['kembalian']));?></td>
                </tr>
                <tr>
                    <td colspan="4" class="kanan">Catatan</td>
                    <td class="kanan"><?=esc($transaksi[0]['catatan']);?></td>
                </tr>
            </table>
        </div>

        <div class="terimakasih">
            ~~~~~ Terima Kasih ~~~~~
        </div>
    </div>
</body>

</html>