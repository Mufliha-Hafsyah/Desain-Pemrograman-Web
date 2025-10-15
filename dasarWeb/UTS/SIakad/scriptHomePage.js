$(document).ready(function() {
  $(".submit-btn").click(function() {
    alert("Tugas berhasil dikumpulkan!");
  });
  
  $(".unduh-btn").click(function() {
    alert("Berhasil mengunduh");
  });

  $("#logout").click(function(e) {
    e.preventDefault();
    if (confirm("Yakin ingin logout?")) {
      window.location.href = "login-page.html";
    }
  });
});