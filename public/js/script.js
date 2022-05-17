const link = window.location;
const BASE_URL = $("#base-url").data("url");

/* tambahkan class active pada menu yang dipilih tanpa class nav-treeview */
$("ul.nav-sidebar a").filter(function () {
    return this.href == link;
}).addClass("active");
/* tambahkan class menu-open pada menu yang dipilih yang ada class nav-treeview */
$("ul.nav-treeview a").filter(function () {
    return this.href == link;
}).parentsUntil(".nav-sidebar > .nav-treeview").addClass("menu-open").prev("a").addClass("active");
// buat animasi loading web
$(".preloader").fadeOut();

// Show Password
function showPassword(button) {
	var inputPassword = $(button).closest('div.input-group-append').parent().find('input');
    var eye = $(button).children().find('span');
	if (inputPassword.attr('type') === "password") {
		inputPassword.attr('type', 'text');
        eye.removeClass('fa-eye-slash').addClass('fa-eye');
	} else {
		inputPassword.attr('type','password');
        eye.removeClass('fa-eye').addClass('fa-eye-slash');
	}
}

$('.show-password').on('click', function(){
	showPassword(this);
})

function responValidasi(target = [], kolom = [], respon = null) {
    
    const keyError = (respon.error != null) ? Object.keys(respon.error) : null; // mendapatkan key error dari respon
    
    if (respon.validasi) {
        // validasi sukses
        $("input").removeClass('is-invalid'); // hapus semua class is-invalid
        for (let index = 0; index < kolom.length; index++) {
            const element = kolom[index];
            if (keyError != null) {
                if (keyError.includes(element)) {
                    // jika ada return error yang sesuai dengan array kolom, maka berikan alert sesuai errornya
                    $("#" + target[0].toLowerCase()).prop("disabled", false).text(target[1])
                    $("input").prop("readonly", false)
                    toastr.error(respon.error[element], '', {
                        timeOut: 3000,
                        closeButton: true,
                        progressBar: true
                    });
                }
            }
            if (respon.sukses) {
                // semua sudah ok
                toastr.success(respon.pesan, '', {
                    timeOut: 3000,
                    closeButton: true,
                    progressBar: true,
                    onHidden: function() {
                        switch (respon.sukses) {
                            case respon.aksi == 'login':
                                window.location.href = `${BASE_URL}/dashboard`;
                                break;
                            case respon.aksi == 'lupa' || respon.aksi == 'ubah':
                                window.location.href = `${BASE_URL}/auth`;
                                break;
                            default:
                                break;
                        }
                    }
                });
                break; // untuk menghentikan dobel perulangan alert
            }
        }
    
    } else {
        // validasi gagal
        $("#" + target[0].toLowerCase()).prop("disabled", false).text(target[1])
        $("input").prop("readonly", false)
        
        for (let index = 0; index < kolom.length; index++) {
            const element = kolom[index];
            if (keyError.includes(element)) {
                const pesan = respon.error[element];
                $("#" + element.toLowerCase()).addClass('is-invalid').parent().find('small').text(pesan); // tambahkan pesan error ke tiap kolom sesuai respon
            } else {
                $("#" + element.toLowerCase()).removeClass('is-invalid'); // hapus pesan errornya
            }
        }
    }
}
