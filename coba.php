<!-- Keluar Parkir -->
<div class="col-md-5" style="margin-top: 30px">
  <div class="col-md-10 panel">
    <div class="col-md-12 panel-heading bg-teal">
      <h4 style="color: white;font-size: 20pt;">Keluar Parkir</h4>
    </div>
    <div class="col-md-12 panel-body" style="padding-bottom:25px;">
      <div class="col-md-12">
        <form class="cmxform" method="POST" id="keluarForm">
          <div class="col-md-12">
            <div class="form-group form-animate-text" style="margin-top:25px !important;">
              <input type="text" class="form-text" name="kode" id="kode_keluar" required>
              <span class="bar"></span>
              <label>Masukan Kode</label>
            </div>
          </div>
          <input class="btn btn-primary col-md-12" type="button" value="Go" style="height: 40px" id="btnKeluar" style="height: 40px">
        </form>
        <!-- Modal -->
        <div class="col-md-12">
          <div class="modal fade modal-v1" id="myModal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h2 class="modal-title">
                    <i class="icon-logout icons"> </i>
                    Keluar Parkir
                  </h2>
                </div>
                <div class="modal-body" style="padding-bottom: 10px;">
                  <h3 id="plat"></h3>
                  <div class="row">
                    <div class="form-group">
                      <label class="col-sm-2 control-label text-right" style="font-size:14px">Jam Masuk</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control android" name="jam_masuk" id="jam_masuk" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group">
                      <label class="col-sm-2 control-label" style="font-size:14px">Jam Keluar</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control android" name="jam_keluar" value="<?php echo $jamkeluar?>" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label text-right" style="font-size:14pt">Total</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control android" name="total" id="total" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label text-right" style="font-size:14pt">Bayar</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control android" name="bayar" id="bayar">
                    </div>
                  </div>
                  <input class="btn btn-primary" type="button" value="Hitung" name="btn_hitung" id="hitung" style="margin: 20px 17px 20px 0; width: 180px; height: 40px; font-weight: bold;">
                  <div class="form-group">
                    <label class="col-sm-2 control-label text-right" style="font-size:14pt">Kembali</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control android" name="kembali" id="kembali" readonly>
                    </div>
                  </div>
                  <input class="btn btn-primary" type="button" value="Submit" name="submit" style="margin: 20px 17px 0 0; height: 40px; font-weight: bold;" id="submitKeluar">
                </div>
                <div class="modal-footer"></div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
        </div>
        <!-- end:Modal -->
      </div>
    </div>
  </div>
</div>
<!-- end:Keluar Parkir -->

<script>
  $(document).ready(function() {
    // Ketika tombol Go di klik
    $('#btnKeluar').click(function() {
      var kode = $('#kode_keluar').val(); // Ambil kode dari input
      $.ajax({
        url: 'get_data.php', // Lokasi file PHP untuk mengambil data
        method: 'POST',
        data: {
          kode: kode
        },
        dataType: 'json',
        success: function(response) {
          if (response.error) {
            alert(response.error);
          } else {
            // Tampilkan data di dalam modal
            $('#plat').text(response.plat);
            $('#jam_masuk').val(response.jam_masuk);
            $('#total').val(response.total); // Set nilai input total
            $('#myModal').modal('show');
          }
        },
        error: function() {
          alert('Terjadi kesalahan saat mengambil data');
        }
      });
    });

    // Ketika tombol Submit di klik
    $('#submitKeluar').click(function() {
      var kode = $('#kode_keluar').val(); // Ambil kode dari input
      var jamKeluar = $('#jam_keluar').val(); // Ambil jam keluar dari input
      $.ajax({
        url: 'update_data.php', // Lokasi file PHP untuk memperbarui data
        method: 'POST',
        data: {
          kode: kode,
          jam_keluar: jamKeluar
        },
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            alert('Data berhasil diperbarui');
            $('#myModal').modal('hide');
          } else {
            alert('Terjadi kesalahan saat memperbarui data');
          }
        },
        error: function() {
          alert('Terjadi kesalahan saat memperbarui data');
        }
      });
    });
  });

  $(document).ready(function() {
    // Ketika tombol Hitung di klik
    $('#hitung').click(function() {
      var total = parseFloat($('#total').val()); // Ambil nilai total dari input
      var bayar = parseFloat($('#bayar').val()); // Ambil nilai bayar dari input

      // Lakukan perhitungan
      var kembali = bayar - total;

      // Tampilkan nilai kembali di input
      $('#kembali').val(kembali.toFixed(2));
    });
  });
</script>
