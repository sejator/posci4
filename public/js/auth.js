// ajax login
$("#login").on("click", function(e) {
    e.preventDefault();
    $("#login").prop("disabled", true).text('Proses...')
    $("input").prop("readonly", true)
    // kirim data
    $.ajax({
        type: $("form").attr("method"),
        url: $("form").attr("action"),
        data: $("form").serialize(),
        success: function(response) {
            responValidasi(['login', 'Login'], ['username', 'password'], response);
        },
        error: (xhr, status, message) => {
            Swal.fire({
                icon: 'error',
                title: 'Oops',
                text: `${message}`
            })
            $("#login").prop("disabled", false).text('Login')
            $("input").prop("readonly", false)
        }
    });
});
// ajax lupa password
$("#lupa").on('click', function(e){
    e.preventDefault();
    $("#lupa").prop("disabled", true).text('Proses...')
    $("input").prop("readonly", true)
    $.ajax({
        type: $("form").attr("method"),
        url: $("form").attr("action"),
        data: $("form").serialize(),
        success: function (response) {
            responValidasi(['lupa', 'Kirim Link'], ['email'], response);
        },
        error: (xhr, status, message) => {
            Swal.fire({
                icon: 'error',
                title: 'Oops',
                text: `${message}`
            })
            $("#lupa").prop("disabled", false).text('Kirim Link')
            $("input").prop("readonly", false)
        }
    });
})
// ajax ubah password
$("#ubah").on('click', function(e){
    e.preventDefault();
    $("#ubah").prop("disabled", true).text('Proses...')
    $("input").prop("readonly", true)
    $.ajax({
        type: $("form").attr("method"),
        url: $("form").attr("action"),
        data: $("form").serialize(),
        success: function (response) {
            responValidasi(['ubah', 'Ubah Password'], ['password', 'konfirmasi_password', 'token'], response);
        },
        error: (xhr, status, message) => {
            Swal.fire({
                icon: 'error',
                title: 'Oops',
                text: `${message}`
            })
            $("#ubah").prop("disabled", false).text('Ubah Password')
            $("input").prop("readonly", false)
        }
    });
})