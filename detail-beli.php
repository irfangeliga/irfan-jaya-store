<?php
require_once('config.php');
session_start();
$id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id = '$id'";
$query = mysqli_query($con, $sql);
$db_toko = mysqli_fetch_assoc($query);

if(!isset($_SESSION['customerijs'])){
  if(!isset($_SESSION['web'])){
    if(!isset($_SESSION['id'])){
      header('location: login.php');
    }
    header('location: login.php');
  }
  header('location: login.php');
}

function rupiah($angka){
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
    <title>Detail Pembelian | Irfan Jaya</title>
  </head>
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
  <body style="background-color:#e6dede">
  <?php require_once('nav-cart.php');?>
  <!-- DETAIL PEMBELIAN -->
  <div class="border w-50 ms-auto me-auto bg-light h-auto " style="margin-top:5rem;">
    <div class="responsive-table p-3">
      <h5>List Pembelian</h5>
      <table class="table table-hover" >
        <thead>
          <tr class="text-center">
            <th>No</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Ukuran</th> 
            <th>Warna</th>
            <th>Jumlah</th>
            <th>Harga per Unit</th>
          </tr>	
        </thead>
        <tbody>
          <?php	
           if(isset($_GET['kode'])){	
              $no = 1;
              $sql_cart = "SELECT * FROM keranjang WHERE id_user = '$id'";
              $query_cart = mysqli_query($con, $sql_cart);
              $row = mysqli_num_rows($query_cart);

              while($cart = mysqli_fetch_array($query_cart)){
                $cart_foto = $cart['foto'];
                $cart_foto = explode("," , $cart_foto);
                $harga_produk = $cart["harga"]; 
          ?>
          <tr class="text-center">
            <th scope="row"><?php echo $no ?></th>
            <td ><img  src="img/produk/<?php echo $cart_foto[0]; ?>" width="50px"></td>
            <td class="text-capitalize"><?php echo $cart["nama"]; ?></td>
            <td style="width:100px;" class="text-uppercase"><?php echo $cart["ukuran"]; ?></td>
            <td class="text-uppercase"><?php echo $cart["warna"]; ?></td>
            <td style="width:100px;"><?php echo $cart["jumlah"]; ?></td>
            <td style="width:200px;"><?php echo rupiah($harga_produk) ?></td>
          </tr>
          <?php
                $no++;
              } 
            }else{
              if(isset($_GET['nama'])){
                $no = 1;
                $id_produk = $_GET['id_produk'];
                $nama = $_GET['nama'];
                $foto = $_GET['foto'];
                $ukuran = $_GET['ukuran'];
                $warna = $_GET['warna'];
                $kuantitas = $_GET['kuantitas'];
                $harga = $_GET['harga'];
                $foto_baju = explode("," , $foto);
                // $tgl = date('d-m-Y'); memanggil tanggal dari computer
                // $time = date('H:i:s'); memanggil waktu dari computer

          ?> 
          <tr class="text-center">
            <th scope="row"><?php echo $no ?></th>
            <td ><img  src="img/produk/<?php echo $foto_baju[0] ?>" width="80px"></td>
            <td style="width:250px;" class="text-capitalize"><?php echo $nama ?></td>
            <td style="width:100px;" class="text-uppercase"><?php echo $ukuran ?></td>
            <td class="text-uppercase"><?php echo $warna?></td>
            <td style="width:100px;"><?php echo $kuantitas ?></td>
            <td><?php echo rupiah($harga) ?></td>
          </tr>
          <?php
                $no++;
              }
            }
          ?>
        </tbody>
      </table>	
    </div>
    <hr style="width:100%; color:black; height:1px;opacity:60%;background-color:black;kmargin:0;">
    <div class="ongkir p-3">
      <div class="preloader">
        <div class="loading">
          <div class="spinner-border" role="status">
          </div>
          <br><br>
          <span>Loading...</span>
        </div>
      </div>
      <h4>Detail Pengiriman</h4>
      <p class="text-danger" style="font-size:14px;">*Mohon Cek Ongkir terlebih dahulu untuk melihat total harga</p><br>
      <label for="alamat">Isi Alamat Lengkap</label><br>
      <div class="input-group mb-3">
        <textarea  class="form-control" aria-describedby="basic-addon1"  disabled><?php echo $db_toko['alamat'] ?></textarea>
        <a type="button" class="input-group-text text-primary text-decoration-none" id="basic-addon1" data-bs-toggle="modal" data-bs-target="#exampleModal2"> Ubah</a>
      </div><br>

      <!-- Modal -->
      <div class="modal fade " id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
          <div class="modal-content">
            <form action="" method="POST" class="form-alamat">
              <div class="modal-header">
                <h5 class="text-end"><label for="alamat">Ketikkan Alamat Baru</label></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id_update" value="<?php echo $id ?>">
                <textarea name="alamat_ubah" class="form-control border-dark" id="alamat" cols="30" rows="4" placeholder="jl manggis no. 1, kecamatan , kabupaten  provinsi" ></textarea><br>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button"  class="btn btn-primary klik-alamat">Ubah</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal -->
      
      <div class="row">
        <div class="col-5">
          <form id="form">
            <div class="form-group mb-3">
              <label for="">Kirim Ke Kota</label>
              <select class="form-control " id="kota_tujuan" required></select>
            </div>
            <div class="form-group">
              <label for="">Pilih Kurir</label>
              <select class="form-control" id="kurir"  required>
                <option value="jne">JNE</option>
                <option value="tiki">TIKI</option>
                <option value="pos">POS INDONESIA</option>
              </select>
            </div><br>
            <button  class="btn btn-sm btn-primary">Cek Ongkir</button>
          </form>
        </div>
        <div class="col-7">
          <div class="card">
            <div class="card-header">
              <h5>Biaya Ongkir</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table text-center" width="100%">
                  <thead>
                    <tr class="">
                      <th width="100px">Layanan</th>
                      <th width="140px">Deskripsi</th>
                      <th width="130px">Harga</th>
                      <th width="120px">Estimasi</th>
                    </tr>
                  </thead>
                  <!-- DATA ONGKIR AKAN DITAMPILKAN DISINI  -->
                  <tbody id="data_table" ></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <form action="proses-pesan.php" method="post" >
      <!-- input hide data -->
        <?php
          if(isset($_GET['nama'])){ 
           $total_berat = 1*200;
           $harga_total = $kuantitas * $harga;
          ?>
          <input type="hidden" name="nama_cart" value="<?php echo $nama ?>">
          <input type="hidden" name="foto_cart" value="<?php echo $foto ?>">
          <input type="hidden" name="ukuran_cart" value="<?php echo $ukuran ?>">
          <input type="hidden" name="warna_cart" value="<?php echo $warna?>">
          <input type="hidden" name="jumlah_cart" value="<?php echo $kuantitas ?>">
          <input type="hidden" name="total"  value="<?php echo $harga_total ?>">
          <input type="hidden" id="berat" value="<?php echo $total_berat ?>">
        <?php } elseif(isset($_GET['kode'])) {

            $total_berat = ($row*200);
            $harga_total=0; 
            foreach ($query_cart as $value) {
              $harga_total += $value['harga'] * $value['jumlah'];

              $foto_cart = $value['foto'];
              $foto_cart = explode("," , $foto_cart);
          ?>
        <input type="hidden" name="id[]" value="<?php echo $value['id_keranjang']; ?>">
        <input type="hidden" name="nama[]" value="<?php echo $value['nama']; ?>">
        <input type="hidden" name="foto[]" value="<?php echo $foto_cart[0]; ?>">
        <input type="hidden" name="ukuran[]" value="<?php echo $value["ukuran"]; ?>">
        <input type="hidden" name="warna[]" value="<?php echo $value["warna"]; ?>">
        <input type="hidden" name="jumlah[]" value="<?php echo $value["jumlah"]; ?>">
        <input type="hidden" name="total" value="<?php echo $harga_total ?>">
        <input type="hidden" id="berat" value="<?php echo $total_berat ?>">
        <?php } }?>
        <input type="hidden" name="id_customer" value="<?php echo $db_toko['id'] ?>">
        <input type="hidden" name="nama_customer" value="<?php echo $db_toko['name'] ?>">
        <input type="hidden" value="284" id="kota_asal" >
        <input type="hidden" name="alamat"  value="<?php echo $db_toko['alamat'] ?>">
      <!-- end -->

      <hr style="width:100%; color:black; height:1px;opacity:60%;background-color:black;margin:0;">
      <div class=" p-3">
        <h5>Pilih Metode Pembayaran</h5>
        <div class="fs-6 mb-2">
          <label>
            <input type="radio" name="metode_bayar" class="form-check-input" value="Transfer Bank - Bank BRI" required>&nbsp;Transfer Bank - Bank BRI
          </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <label class="text-secondary">
            <input type="radio" name="metode_bayar"  class="form-check-input" value="Dompet Digital - DANA" disabled>&nbsp;Dompet Digital - DANA
          </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <label class="text-secondary">
            <input type="radio" name="metode_bayar"  class="form-check-input" value="Bayar di tempat/COD" disabled>&nbsp;Bayar di tempat/COD
          </label>
        </div>
        <div class="text-danger" style="font-size:80%">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*Sistem metode pembayaran melalui DANA dan COD masih dalam proses pengembangan
        </div>
      </div>
      <hr style="width:100%; color:black; height:3px;opacity:60%;background-color:black;kmargin:0;">
      <div class="detail-pesan p-3" >
        <div id="harga"></div>
      </div>
      <div class="text-center">
        <?php require_once('pesan.php') ?>
      </div>
      <!-- <a  href="detail-beli.php?kode=cart" class="btn btn-primary rounded-0 fs-5" >Beli Sekarang</a> -->
    </form>
  </div>
  <!-- END -->

  <script src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function(){
      $('.klik-alamat').click(function(){
        var data =$('.form-alamat').serialize();
        $.ajax({
          type:'POST',
          url:'proses-pesan.php?menu=alamat',
          data:data,
          success:function(){
            alert("berhasil");
            location.reload();
          },
        });
      });
    });

    $(document).ready(function () {
      //MENGAMBIL DATA KOTA/KABUPATEN DENGAN AJAX
      $.ajax({
        type: "GET",
        url: "kota.php",
        success: function (res) {
          
          $(".preloader").hide()
    
          var data_option = "";
    
          //MENGAMBIL STRING JSON DAN MENGKONVERSI KE JAVASCRIPT OBJECT
          var data = JSON.parse(res);
          // var asal = `<option value="284">Mimika, Provinsi Papua</option>`;
          //MAPPING
          data.rajaongkir.results.map((value) => {
            //MASUKAN DATA KE DALAM variable data_option
            data_option += `<option value="${value.city_id}"> ${value.city_name},\n Provinsi ${value.province}</option>`;
          });
    
          //TAMPILKAN DATA DI DALAM DROPDOWN SELECT
          // $("#kota_asal").html(asal);
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
          var kurir =document.getElementById("kurir").value;
          ////MENGAMBIL STRING JSON DAN MENGKONVERSI KE JAVASCRIPT OBJECT
          var data = JSON.parse(res);
          var harga = <?php echo $harga_total ?>;
          var int_nilai = parseInt(harga); 
          
          //MAPPING
          data.rajaongkir.results.map((value) => [
            value.costs.map((value2, index) => {

              jumlah = value2.cost[0]["value"] + int_nilai;
              // total = ${Intl.NumberFormat().format(jumlah)};
              harga = ` <h5>Subtotal</h5>
                        <h6>total harga Produk : <?php echo rupiah($harga_total) ?> </h6>
                        <h6>Ongkos Kirim : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Rp ${Intl.NumberFormat().format(value2.cost[0]["value"])}</h6>
                        <h4 class="text-end text-danger">Total Pembayaran</h4>
                        <h4 class="text-end text-danger">${ Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(jumlah)}</h4>
                        <input type="hidden" name="ongkir" value="${value2.cost[0]["value"]} ">
                        <input type="hidden" name="detail" value="${value2.description} ">
                        <input type="hidden" name="estimasi" value="${value2.cost[0]["etd"]} ">
                        <input type="hidden" name="kurir" value="${kurir} ">`;
                        

              //MASUKAN DATA KE DALAM VAR data_table
              data_table = `<tr>
                      <td style='width:70px;'>${value2.service}</td> 
                      <td class='text-start'>${value2.description}</td>  
                      <td style='width:150px;'>${Intl.NumberFormat("id-ID", {style: "currency", currency: "IDR"}).format(value2.cost[0]["value"])}</td> 
                      <td style='width:70px;'>${value2.cost[0]["etd"]} Hari</td> 
                  </tr>`;
            }),
          ]);
    
          //TAMPILKAN DATA PADA TABEL
          $("#data_table").html(data_table);
          $("#harga").html(harga);

        },
      });
    };
  </script>
</body>
</html>
