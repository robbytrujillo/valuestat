$(document).ready(function() {
    // Sembunyikan alert setelah 5 detik
    setTimeout(function() {
      $("#pesan-sukses").fadeOut("slow");
    }, 5000); // 5000 milidetik = 5 detik

    setTimeout(function() {
        $('#pesan-gagal').fadeOut("slow");
    }, 5000);
  });

