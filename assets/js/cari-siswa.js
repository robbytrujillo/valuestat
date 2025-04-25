$(document).ready(function() {
    // Saat user mengetik di input nama siswa
        $("#nama").on("input", function() {
            var nama = $(this).val();
            if (nama.length > 2) {  // Minimal 3 karakter untuk pencarian
                $.ajax({
                    url: "../../models/cari-siswa.php",
                    type: "GET",
                    data: {nama: nama},
                    success: function(response) {
                        let data = JSON.parse(response);
                        if (data.length > 0) {
                            $("#suggestions").empty().show();
                            data.forEach(function(item) {
                                $("#suggestions").append(`<a href="#" class="list-group-item list-group-item-action" onclick="pilihSiswa('${item.nama}', '${item.nis}', '${item.kelas}')">${item.nama}</a>`);
                            });
                        } else {
                            $("#suggestions").hide();
                        }
                                        }
                });
            } else {
                $("#suggestions").hide();
            }
        });
    });

    // Fungsi untuk mengisi input otomatis setelah memilih nama siswa
    function pilihSiswa(nama, nis, kelas) {
        $("#nama").val(nama);
        $("#nis").val(nis);
        $("#kelas").val(kelas);
        $("#suggestions").hide();
    }