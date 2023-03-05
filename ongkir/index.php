
    <!DOCTYPE html>
        <html lang="en">
          <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <meta http-equiv="X-UA-Compatible" content="ie=edge" />
            <meta name="Description" content="Enter your description here" />
            <link
              rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css"
            />
            <link
              rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
            />
            <link
              href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
              rel="stylesheet"
            />
            <style type="text/css">
              .preloader {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 9999;
              }
              .loading {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                font: 14px arial;
              }
            </style>
            <title>Aplikasi Ongkos Kirim</title>
          </head>
          <body>
            <!-- SPINNER LOADER AKAN DITAMPILKAN SEBELUM DATA KOTA SELESAI DILOAD -->
            <div class="preloader">
              <div class="loading">
                <div class="spinner-border" role="status">
                </div>
                <br><br>
                <span>Loading...</span>
              </div>
            </div>
            <div class="container">
              <div class="row mt-5">
                <div class="col-lg-4">
                  <div class="card">
                    <div class="card-header">
                      <h3>Cek Ongkir</h3>
                    </div>
                    <div class="card-body">
                      <form id="form">
                        <div class="form-group">
                          <label for="">Kota Asal</label>
                          <select class="form-control select2" id="kota_asal" required>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="">Kota Tujuan</label>
                          <select class="form-control select2" id="kota_tujuan" required></select>
                        </div>
                        <div class="form-group">
                          <label for="">Berat(gram)</label>
                          <input type="number" class="form-control" id="berat" required/>
                        </div>
                        <div class="form-group">
                          <label for="">Kurir</label>
                          <select class="form-control" id="kurir" required>
                            <option value="jne">JNE</option>
                            <option value="tiki">TIKI</option>
                            <option value="pos">POS INDONESIA</option>
                          </select>
                        </div>
                        <button class="btn btn-sm btn-primary">Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8">
                  <div class="card">
                    <div class="card-header">
                      <h3>Biaya Ongkir</h3>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Layanan</th>
                              <th>Deskripsi</th>
                              <th>Harga</th>
                              <th>Estimasi(Hari)</th>
                            </tr>
                          </thead>
                          <!-- DATA ONGKIR AKAN DITAMPILKAN DISINI  -->
                          <tbody id="data_table"></tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script>
              $(document).ready(function () {
                $(".select2").select2({
                  placeholder: "Pilih kota/kabupaten",
                  language: "id",
                });
        
                //MENGAMBIL DATA KOTA/KABUPATEN DENGAN AJAX
                $.ajax({
                  type: "GET",
                  url: "kota.php",
                  success: function (res) {
                    
                    $(".preloader").hide()
        
                    var data_option = "";
        
                    //MENGAMBIL STRING JSON DAN MENGKONVERSI KE JAVASCRIPT OBJECT
                    var data = JSON.parse(res);
        
                    //MAPPING
                    data.rajaongkir.results.map((value) => {
                      //MASUKAN DATA KE DALAM variable data_option
                      data_option += `<option value="${value.city_id}">${value.type} ${value.city_name},${value.province}</option>`;
                    });
        
                    //TAMPILKAN DATA DI DALAM DROPDOWN SELECT
                    $("#kota_asal").html(data_option);
                    $("#kota_tujuan").html(data_option);
                  },
                });
              });
        
              //KETIKA FORM DISUBMIT
              form.onsubmit = (e) => {
        
                //CEGAH HALAMAN MELAKUKAN RELOAD
                e.preventDefault();
        
                //TAMPILKAN LOADER
                $(".preloader").show()
        
                //KIRIM DATA DENGAN AJAX
                $.ajax({
                  type: "POST",
                  url: "cek_ongkir.php",
                  data: {
        
                    //MENGAMBIL DATA DARI FORM
                    kota_asal: $("#kota_asal").val(),
                    kota_tujuan: $("#kota_tujuan").val(),
                    berat: $("#berat").val(),
                    kurir: $("#kurir").val(),
                  },
        
                  //PROMISE IF SUCCESS
                  success: function (res) {
        
                    //HILANGKAN LOADER
                    $(".preloader").hide()
        
                    var data_table = "";
        
                    ////MENGAMBIL STRING JSON DAN MENGKONVERSI KE JAVASCRIPT OBJECT
                    var data = JSON.parse(res);
        
                    //MAPPING
                    data.rajaongkir.results.map((value) => [
                      value.costs.map((value2, index) => {
        
                        //MASUKAN DATA KE DALAM VAR data_table
                        data_table += `<tr>
                                <td>${index +1}</td>
                                <td>${value2.service}</td> 
                                <td>${value2.description}</td>  
                                <td>Rp. ${Intl.NumberFormat().format(value2.cost[0]["value"])}</td> 
                                <td>${value2.cost[0]["etd"]}</td> 
                            </tr>`;
                      }),
                    ]);
        
                    //TAMPILKAN DATA PADA TABEL
                    $("#data_table").html(data_table);
                  },
                });
              };
            </script>
          </body>
        </html>