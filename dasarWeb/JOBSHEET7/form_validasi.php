<!DOCTYPE html>
<html>
<head>
    <title>Form Input dengan Validasi</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Form Input dengan Validasi!</h1>
    
    <form id="hi-form" method="post" action="proses_validasi.php">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama">
        <span id="nama-error" style="color: red;"></span><br><br>
        
        <label for="email">Email:</label>
        <input type="text" id="email" name="email">
        <span id="email-error" style="color: red;"></span><br><br>
        
        <label for="password">Password (min 8 karakter):</label>
        <input type="password" name="password" id="password" required>
        <span id="password-error" style="color: red;"></span><br><br>
        
        <input type="submit" value="Submit">
    </form>
    
    <div id="hasil"></div>
    
    <script>
        $(document).ready(function() {
            $("#hi-form").submit(function(event) {
                event.preventDefault(); 
                
                var nama = $("#nama").val();
                var email = $("#email").val();
                var password = $("#password").val();
                var valid = true;
                
                // Variabel yang akan digunakan oleh AJAX
                var formData = $(this).serialize();

                // --- Validasi Nama ---
                if (nama === "") {
                    $("#nama-error").text("Nama harus diisi.");
                    valid = false;
                } else {
                    $("#nama-error").text("");
                }
                
                // --- Validasi Email ---
                if (email === "") {
                    $("#email-error").text("Email harus diisi.");
                    valid = false;
                } else {
                    $("#email-error").text("");
                }
                
                // --- Validasi Password  ---
                if (password.length < 8) {
                    $("#password-error").text("Password minimal 8 karakter.");
                    valid = false;
                } else {
                    $("#password-error").text("");
                }

                if (valid) {
                    $.ajax({
                        url: $(this).attr("action"), 
                        type: $(this).attr("method"), 
                        data: formData,
                        success: function(response) {
                            $("#hasil").html("Sukses dikirim: " + response); 
                        },
                        error: function(response) {
                            $("#hasil").html("Terjadi kesalahan saat mengirim data.");
                        }
                    });
                } else {
                    // Jika validasi gagal
                    $("#hasil").html("Harap perbaiki kesalahan di formulir.");
                }
            });
        });
    </script>
</body>
</html>