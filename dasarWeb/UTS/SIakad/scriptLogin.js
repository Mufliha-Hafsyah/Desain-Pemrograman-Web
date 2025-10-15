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
    }else{
        window.open('homePage.php'); 
    }
  });
});
