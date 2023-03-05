<?php
require_once('config.php');
session_start();
$id = $_SESSION['id'];

if(!isset($_SESSION['customerijs'])){
  if(!isset($_SESSION['web'])){
    if(!isset($_SESSION['id'])){
      header('location: login.php');
    }
    header('location: login.php');
  }
  header('location: login.php');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
    <title>Cetak Dokumen | Irfan Jaya</title>
  </head>
  <body>
    <br><br><br><br><br><br>
    <?php 
       $query_jual = "SELECT * FROM riwayat where id_user = '$id'";
       $sql_jual = mysqli_query($con,$query_jual);
       $row = mysqli_num_rows($sql_jual);
       
    ?>
    <section style="margin-bottom:27.7rem;width:30rem;margin-left:auto;margin-right:auto;" >
      <?php if($row != 0 ){
        while($jual = mysqli_fetch_array($sql_jual)){ 
        $total  = $jual['ongkir_riwayat']+ $jual['harga_riwayat'];
      ?>
      <div style="height:38rem;" class=" p-5  border border-dark border-2">
        <h5 class="text-start " >Irfan Jaya Store</h5>
        <hr class="p-0">
        <div class="row mb-3">
          <div class="col-5">Produk</div>
          <div class="col-1">:</div>
          <div class="col-6"><?php echo $jual['produk_riwayat'] ?></div>
        </div>
        <div class="row mb-3">
          <div class="col-5">Ukuran</div>
          <div class="col-1">:</div>
          <div class="col-6"><?php echo $jual['ukuran_riwayat'] ?></div>
        </div>
        <div class="row mb-3">
          <div class="col-5">Warna</div>
          <div class="col-1">:</div>
          <div class="col-6"><?php echo $jual['warna_riwayat'] ?></div>
        </div>
        <div class="row mb-3">
          <div class="col-5">Jumlah</div>
          <div class="col-1">:</div>
          <div class="col-6"><?php echo $jual['jumlah_riwayat'] ?></div>
        </div>
        <div class="row mb-3">
          <div class="col-5">Metode</div>
          <div class="col-1">:</div>
          <div class="col-6"><?php echo $jual['metode_pembayaran'] ?></div>
        </div>
        <div class="row mb-3">
          <div class="col-5">Ongkir</div>
          <div class="col-1">:</div>
          <div class="col-6"><?php echo $jual['ongkir_riwayat'] ?></div>
        </div>
        <div class="row mb-3">
          <div class="col-5">Harga</div>
          <div class="col-1">:</div>
          <div class="col-6"><?php echo $jual['harga_riwayat'] ?></div>
        </div>
        <div class="row mb-3">
          <div class="col-5">Total Harga</div>
          <div class="col-1">:</div>
          <div class="col-6"><?php echo $total ?></div>
        </div>
        <div class="row mb-3">
          <div class="col-5"> Waltu & harga</div>
          <div class="col-1">:</div>
          <div class="col-6"><?php echo $jual['tanggal']."&nbsp;|&nbsp;".$jual['waktu'] ?></div>
        </div><br><br>
        <div class="text-end" style="border:none;">
          <a  href="" onclick="printPage()"> Download Struck</a>
        </div>
      </div>
      <?php } } ?>
    </section> 

    <?php require_once('footer.php'); ?>

    <script type="text/javascript">
         function printPage() {
            window.print();
            }
    </script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>