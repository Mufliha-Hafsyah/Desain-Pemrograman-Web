$(document).ready(function() {
    $("#loginForm").on("submit", function(e) {
        e.preventDefault(); 

        const nim = $("#nim").val().trim();
        const password = $("#password").val().trim();
        $("#errorMsg").text(""); 

        if (nim === "" && password === "") {
            $("#errorMsg").text("NIM dan Password tidak boleh kosong!");
            return;
        } else if(nim === ""){
            $("#errorMsg").text("NIM tidak boleh kosong!");
            return;
        } else if(password === ""){
            $("#errorMsg").text("Password tidak boleh kosong!");
            return;
        }

        $.ajax({
            url: "login.php",
            type: "POST",
            data: { NIM: nim, password: password },
            success: function (response) {
              if (response.trim() === "success") {
                window.open('homePage.php', '_blank');
              } else {
                $("#errorMsg").text(response);
              }
            },
            error: function () {
              $("#errorMsg").text("Terjadi kesalahan koneksi ke server.");
            },
        });
    });
});