$(document).ready(function () {
    $("#registerForm").on("submit", function (e) {
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
            url: "CRUD/register.php",
            type: "POST",
            data: { NIM: nim, password: password, USERNAME: username },
            success: function (response) {
                console.log("register.php response:", response);
                if (response.trim() === "success_register") {
                    alert("Registrasi Berhasil! Silakan login.");
                    window.location.href = 'login-page.php';
                } else {
                    $("#errorMsgRegister").text(response);
                }
            },
            error: function () {
                console.log("AJAX error calling register.php");
                $("#errorMsgRegister").text("Terjadi kesalahan koneksi ke server.");
            },
        });
    });

    function formClear() {
        $("#username_register").val("");
        $("#nim_register").val("");
        $("#password_register").val("");
    }

    $("#close_register").on("click", function () {
        formClear();
        $("#errorMsgRegister").text("");
    });
});
