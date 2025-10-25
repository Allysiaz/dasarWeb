$(document).ready(function() {
    $('#loginForm').submit(function(e) {
        var username = $('#username').val();
        var password = $('#password').val();
        var isValid = true;
        var message = '';

        if (username.length < 3) {
            message += 'Username minimal 3 karakter.<br>';
            isValid = false;
        }

        if (password.length < 4) {
            message += 'Password minimal 4 karakter.<br>';
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault(); // Mencegah submit form
            $('#alertMessage').html(message).slideDown('slow'); // Menampilkan pesan
        } else {
            $('#alertMessage').slideUp('slow'); // Menyembunyikan pesan jika valid
        }
    });
});