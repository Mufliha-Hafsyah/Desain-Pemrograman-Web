$(document).ready(function() {
    $("#registerForm").on("submit", function(e) {
        e.preventDefault();

        const username = $("#username_register").val().trim();
        const nim = $("#nim_register").val().trim(); 
        const password = $("#password_register").val().trim();
        
        $("#errorMsgRegister").text(""); 

        if (nim === "" || password === "" || username === "") {
            $("#errorMsgRegister").text("NIM, Username, dan Password tidak boleh kosong!");
            return;
        }

        $.ajax({
            url: "register.php",
            type: "POST",
            data: { NIM: nim, password: password, USERNAME: username },
            success: function (response) {
                console.log('register.php response:', response);
                if (response.trim() === "success_register") {
                    alert("Registrasi Berhasil! Silakan login.");
                    $("#nim").val(nim); 
                    $("#password").val("");
                } else {
                    $("#errorMsgRegister").text(response);
                }
            },
            error: function () {
                console.log('AJAX error calling register.php');
                $("#errorMsgRegister").text("Terjadi kesalahan koneksi ke server.");
            },
        });
    });

    $("#close_register").on("click", function() {
        
        $("#username_register").val("");
        $("#nim_register").val("");
        $("#password_register").val("");
        
        $("#errorMsgRegister").text("");
    });
})