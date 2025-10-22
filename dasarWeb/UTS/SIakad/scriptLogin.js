$(document).ready(function() {
  $("#loginForm").on("submit", function(e) {
    e.preventDefault(); // mencegah reload

    const nim = $("#nim").val().trim();
    const password = $("#password").val().trim();

    if (nim === "" && password === "") {
        $("#errorMsg").text("Username dan Password tidak boleh kosong!");
        return;
    } else if(nim === ""){
        $("#errorMsg").text("Username tidak boleh kosong!");
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
              window.open('homePage.php');
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
