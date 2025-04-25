$(document).ready(function() {
    // Saat user mengetik di input nama siswa
        $("#nama_mapel").on("input", function() {
            var nama_mapel = $(this).val();
            if (nama_mapel.length > 2) {  // Minimal 3 karakter untuk pencarian
                $.ajax({
                    url: "../../models/cari-mapel.php",
                    type: "GET",
                    data: {nama_mapel: nama_mapel},
                    success: function(response) {
                        let data = JSON.parse(response);
                        if (data.length > 0) {
                            $("#suggestions-mapel").empty().show();
                            data.forEach(function(item) {
                                $("#suggestions-mapel").append(`<a href="#" class="list-group-item list-group-item-action" onclick="pilihMapel('${item.nama_mapel}')">${item.nama_mapel}</a>`);
                            });
                        } else {
                            $("#suggestions-mapel").hide();
                        }
                                        }
                });
            } else {
                $("#suggestions-mapel").hide();
            }
        });
    });

    // Fungsi untuk mengisi input otomatis setelah memilih nama siswa
    function pilihMapel(nama_mapel) {
        $("#nama_mapel").val(nama_mapel);
        $("#suggestions-mapel").hide();
    }