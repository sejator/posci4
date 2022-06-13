$(function () {
  if (window.location == `${BASE_URL}/penjualan`) {
    $('body').addClass('sidebar-collapse')
    $('.content-header').remove()
    $('.content').addClass('pt-2')
  }

  /**
   * Fungsi untuk membuat format ribuan
   */
  function rupiah(nominal) {
    let number_string = nominal.toString(), // convert nominal ke string
      sisa = number_string.length % 3, // cek jumlah digit bukan kelipatan 3
      rupiah = number_string.substr(0, sisa),
      ribuan = number_string.substr(sisa).match(/\d{3}/g)
    if (ribuan) {
      let separator = sisa ? '.' : ''
      rupiah += separator + ribuan.join('.')
    }
    return rupiah
  }

  /**
   * Menampilkan detail isi keranjang
   */
  function detailKeranjang() {
    let keranjang = ''
    $.ajax({
      url: `${BASE_URL}/penjualan/keranjang`,
      dataType: 'json',
      success: function (response) {
        $('#invoice').text(response.invoice) // menampilkan no invoice
        $('#tampilkan_total').text(rupiah(response.sub_total)) // menampilkan total harga
        $('#sub_total').val(response.sub_total) // isi value sub_total
        $('#total_akhir').val(response.sub_total) // isi value total_akhir
        // menampilkan detail keranjang
        if (response.keranjang.length === 0) {
          keranjang = `<tr><td colspan="7" class="text-center">Keranjang masih kosong</td></tr>`
          $('#diskon').prop('disabled', true)
          $('#tunai').prop('disabled', true)
          $('#catatan').prop('disabled', true)
          $('#batal').prop('disabled', true)
        } else {
          $('#diskon').prop('disabled', false)
          $('#tunai').prop('disabled', false)
          $('#catatan').prop('disabled', false)
          $('#batal').prop('disabled', false)
          // $("#tunai").val(0);

          $.each(response.keranjang, function (i, data) {
            keranjang += `<tr>
						<td>${data.barcode}</td>
						<td>${data.nama}</td>
						<td>${data.harga}</td>
						<td>${data.jumlah}</td>
						<td>${data.diskon}</td>
						<td>${data.total}</td>
						<td>
							<button class="btn btn-success btn-sm" id="edit-item" data-toggle="modal" data-target="#modal-item-edit" data-id="${data.id}" data-barcode="${data.barcode}" data-item="${data.nama}" data-harga="${data.harga}" data-jumlah="${data.jumlah}" data-diskon="${data.diskon}" data-subtotal="${data.total}" data-stok="${data.stok}"><i class="fa fa-edit"></i></button>
							<button class="btn btn-danger btn-sm" id="hapus-item" data-id="${data.id}"><i class="fa fa-trash"></i></button>
						</td>
						</tr>`
          })
        }
        $('tbody').html(keranjang)
      },
    })
  }
  detailKeranjang() // pertama halaman dibuka load detail keranjang

  // Cari item berdasarkan barcode
  $('#barcode').autocomplete({
    source: `${BASE_URL}/item/barcode`,
    autoFocus: true,
    select: function (e, ui) {
      $.ajax({
        url: `${BASE_URL}/item/detail`,
        type: 'get',
        data: {
          barcode: ui.item.value,
        },
        success: function (response) {
          $('#iditem').val(response.iditem)
          $('#barcode').val(response.barcode)
          $('#nama').val(response.item)
          $('#harga').val(response.harga)
          $('#stok').val(response.stok)
          $('#tampil-stok').text(`Stok Produk ${response.stok}`)
          if (response.stok == 0) {
            $('#jumlah').prop('disabled', true)
          } else {
            $('#jumlah').prop('disabled', false).focus()
          }
        },
      })
    },
  })

  $('#jumlah').on('keyup', function (e) {
    let jumlah = parseInt(e.target.value)
    let barcode = $('#barcode').val()

    if (isNaN(jumlah) || jumlah == 0) {
      $('#tambah').prop('disabled', true)
    } else {
      $.ajax({
        url: `${BASE_URL}/penjualan/cekStok`,
        data: {
          barcode: barcode,
        },
        success: (respon) => {
          if (jumlah > respon.stok) {
            Swal.fire({
              title: `Jumlah melebihi stok, maksimal ${respon.stok}`,
              icon: 'warning',
            }).then((res) => {
              e.target.value = 1
            })
          }
        },
      })
      $('#tambah').prop('disabled', false)
    }
  })

  $('#tambah').on('click', function (e) {
    tambahKeKranjang()
  })
  $('#jumlah').on('keypress', function (e) {
    if (e.keyCode === 13 && e.target.value != '') {
      tambahKeKranjang()
    }
  })

  function tambahKeKranjang() {
    let iditem = $('#iditem').val()
    let barcode = $('#barcode').val()
    let nama = $('#nama').val()
    let harga = $('#harga').val()
    let stok = parseInt($('#stok').val())
    let jumlah = parseInt($('#jumlah').val())

    $.ajax({
      url: `${BASE_URL}/penjualan/tambah`,
      method: 'post',
      data: {
        [$('#token').attr('name')]: $('#token').val(),
        iditem: iditem,
        barcode: barcode,
        nama: nama,
        harga: harga,
        jumlah: jumlah,
        stok: stok,
      },
      success: function (response) {
        if (response.status) {
          detailKeranjang()
          $('#jumlah').val('').prop('disabled', true)
          $('#tambah').prop('disabled', true)
          $('#barcode').val('').focus()
          $('#tampil-stok').text('')
          toastr.success(response.pesan, 'Sukses', { timeOut: 500 })
        } else {
          toastr.error(response.pesan)
        }
      },
    })
  }

  // tambahkan item ke keranjang
  /*
  $(document).on('keypress keyup', '#jumlah', function (e) {
    let iditem = $('#iditem').val()
    let barcode = $('#barcode').val()
    let nama = $('#nama').val()
    let harga = $('#harga').val()
    let stok = parseInt($('#stok').val())
    let jumlah = parseInt($('#jumlah').val())
    if (jumlah > stok) {
      $('#jumlah').val(1)
      toastr.error(`Jumlah melebihi stok, maksimal ${stok}`, 'Informasi', {
        timeOut: 500,
      })
    }

    if (e.keyCode === 13 && jumlah != '' && jumlah > 0) {
      $.ajax({
        url: `${BASE_URL}/penjualan/tambah`,
        method: 'post',
        data: {
          [$('#token').attr('name')]: $('#token').val(),
          iditem: iditem,
          barcode: barcode,
          nama: nama,
          harga: harga,
          jumlah: jumlah,
          stok: stok,
        },
        success: function (response) {
          if (response.status) {
            detailKeranjang()
            $('#jumlah').val('').prop('disabled', true)
            $('#barcode').val('').focus()
            $('#tampil-stok').text('')
            toastr.success(response.pesan, 'Sukses', { timeOut: 500 })
          } else {
            toastr.error(response.pesan)
          }
        },
      })
    }
  })
	*/

  // hapus item di keranjang
  $('.content').on('click', '#hapus-item', function () {
    Swal.fire({
      title: 'Yakin ingin menghapus item ini?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Konfirmasi!',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: `${BASE_URL}/penjualan/hapus`,
          type: 'post',
          data: {
            [$('#token').attr('name')]: $('#token').val(),
            iditem: $(this).data('id'),
          },
          success: function (response) {
            if (response.status) {
              detailKeranjang()
              $('#tunai').val(0)
              toastr.success(response.pesan, 'Sukses', { timeOut: 500 })
            } else {
              toastr.error(response.pesan, 'Error', { timeOut: 500 })
            }
          },
        })
      }
    })
  })

  // modal form edit item keranjang
  $('.content').on('click', '#edit-item', function () {
    // mengambil data dari tombol select, input ke tiap-tiap elemet
    $('#item_id').val($(this).data('id'))
    $('#item_barcode').val($(this).data('barcode'))
    $('#item_nama').val($(this).data('item'))
    $('#item_harga').val($(this).data('harga'))
    $('#item_jumlah')
      .val($(this).data('jumlah'))
      .prop('max', $(this).data('stok'))
    $('#item_stok').val($(this).data('stok'))
    $('#modal-stok').text('Stok produk ' + $(this).data('stok'))
    $('#item_diskon').val($(this).data('diskon'))
    $('#harga_sebelum_diskon').val($(this).data('subtotal'))
    $('#harga_setelah_diskon').val($(this).data('subtotal'))
  })

  // update isi keranjang
  $('.wrapper').on('click', '#edit-keranjang', function () {
    $.ajax({
      url: `${BASE_URL}/penjualan/ubah`,
      type: 'post',
      dataType: 'json',
      data: $('form').serialize(),
      success: function (response) {
        $('#modal-item-edit').modal('hide')
        $('#barcode').focus()
        detailKeranjang()
        toastr.success(response.pesan, 'Sukses', { timeOut: 500 })
      },
    })
  })

  /**
   * Form modal update live
   */
  function modal_edit_item() {
    let jumlah = $('#item_jumlah').val()
    let harga = $('#item_harga').val()
    let stok = $('#item_stok').val()
    let item_diskon = $('#item_diskon').val()

    if (parseInt(jumlah) > parseInt(stok)) {
      toastr.error('Jumlah melebihi stok, maksimal ' + stok, '', {
        timeOut: 500,
      })
      $('#item_jumlah').val(1)
    } else if (jumlah == '' || jumlah < 1) {
      toastr.error('Jumlah minimal 1', '', { timeOut: 500 })
      $('#item_jumlah').val(1)
    }

    let harga_sebelum_diskon = jumlah * harga
    $('#harga_sebelum_diskon').val(harga_sebelum_diskon)
    if (item_diskon == '' || item_diskon == 0) {
      $('#item_diskon').val(0)
      $('#harga_setelah_diskon').val(harga_sebelum_diskon)
    } else {
      hasil_diskon = (item_diskon / 100) * harga_sebelum_diskon
      $('#harga_setelah_diskon').val(harga_sebelum_diskon - hasil_diskon)
    }
  }

  /**
   * Hitung kalkulasi diskon, total belanja dan kembalian
   */
  function kalkulasi() {
    let sub_total = $('#sub_total').val(),
      diskon_akhir = ($('#diskon').val() / 100) * sub_total,
      total_akhir = sub_total - diskon_akhir,
      tunai = $('#tunai').val().replace('.', ''),
      kembalian =
        tunai - total_akhir > 0
          ? rupiah(tunai - total_akhir)
          : tunai - total_akhir

    $('#total_akhir').val(total_akhir)
    $('#tampilkan_total').text(rupiah(total_akhir))
    tunai != 0 ? $('#kembalian').val(kembalian) : $('#kembalian').val(0)
    if (tunai == 0 || tunai == '') {
      $('#bayar').prop('disabled', true)
    } else if (kembalian < 0) {
      $('#bayar').prop('disabled', true)
    } else {
      $('#bayar').prop('disabled', false)
    }
  }

  // jika kolom diskon dan tunai di edit load kalkulasi
  $('.wrapper').on('keyup mouseup', '#diskon, #tunai', function (e) {
    kalkulasi()
  })
  // jika kolom jumlah dan diskon di edit update isi total otomatis
  $('.wrapper').on('keyup mouseup', '#item_jumlah, #item_diskon', function () {
    modal_edit_item()
  })

  // batalkan pembayaran
  $('.wrapper').on('click', '#batal', function () {
    Swal.fire({
      title: 'Yakin ingin membatalkan transaksi?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Konfirmasi!',
      cancelButtonText: 'Tidak',
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: `${BASE_URL}/penjualan/hapus`,
          success: function (response) {
            detailKeranjang()
            $('#pelanggan').val('')
            $('#diskon').val(0)
            $('#tunai').val(0)
            $('#kembalian').val(0)
            $('#barcode').focus()
            toastr.success(response.pesan, '', { timeOut: 500 })
          },
        })
      }
    })
  })

  // proses pembayaran
  $('.wrapper').on('click', '#bayar', function () {
    let id_pelanggan = $('#pelanggan').val()
    let subtotal = $('#sub_total').val()
    let diskon = $('#diskon').val()
    let total_akhir = $('#total_akhir').val()
    let tunai = $('#tunai').val()
    let kembalian = $('#kembalian').val()
    let catatan = $('#catatan').val()
    let tanggal = $('#tanggal').val()

    if (tunai < 1) {
      toastr.error('Jumlah uang tunai belum diinput', '', { timeOut: 500 })
      $('#tunai').focus()
    } else {
      // semua sudah oke
      Swal.fire({
        title: 'Yakin proses transaksi sudah benar?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Konfirmasi!',
        cancelButtonText: 'Batal',
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: `${BASE_URL}/penjualan/bayar`,
            type: 'post',
            dataType: 'json',
            data: {
              [$('#token').attr('name')]: $('#token').val(),
              id_pelanggan: id_pelanggan,
              subtotal: subtotal,
              diskon: diskon,
              total_akhir: total_akhir,
              tunai: tunai,
              kembalian: kembalian,
              catatan: catatan,
              tanggal: tanggal,
            },
            success: function (response) {
              if (response.status) {
                Swal.fire({
                  icon: 'success',
                  title: 'Sukses!',
                  text: `${response.pesan}`,
                  // confirmButtonText: 'Konfirmasi'
                  showConfirmButton: false,
                  timer: 1500,
                }).then((res) => {
                  window.open(
                    `${BASE_URL}/penjualan/cetak/${response.idpenjualan}`
                  )
                  location.reload(true)
                })
              } else {
                toastr.error(response.pesan)
              }
            },
          })
        }
      })
    }
  })
})
