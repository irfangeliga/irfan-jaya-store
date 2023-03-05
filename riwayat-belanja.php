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
    <title>Riwayat Belanja Saya Produk Pria | Irfan Jaya</title>
  </head>
  <body>
    <?php require_once('nav-cart.php');?>
    <br><br><br>
    <h1 class="p-4 ">Terima Kasih Telah melakukan Pemesanan di Irfan Jaya Store</h1>
    <?php 
       $no = 1;
       $query_jual = "SELECT * FROM riwayat where id_user = '$id'";
       $sql_jual = mysqli_query($con,$query_jual);
       $row = mysqli_num_rows($sql_jual);
       
    ?>
    <section style="margin-bottom:27.7rem;"  >
      <?php if($row != 0 ){
        while($jual = mysqli_fetch_array($sql_jual)){ 
        $total  = $jual['ongkir_riwayat']+ $jual['harga_riwayat'];
      ?>
      <hr class="m-0">
      <div class="p-4 ">
        <div class="row ms-auto me-auto">
          <div class="col-1 " style="width:50px;">
            <?php echo $no."." ?>
          </div>
          <div class="col-1 border-start border-primary border-top"><br>
            <p>Produk</p>
            <p>Ukuran</p>
            <p>warna </p>
            <p>Jumlah</p>
            <p>Metode</p>
            <p>Ongkir</p>
            <p>Harga </p>
            <p>Total Harga</p>
            <p>Waltu & harga</p><br>
            <p>TTD</p><br>
            <p>Pemilik Toko Irfan Jaya</p>
          </div>
          <div class="col-2 border-end border-bottom border-primary"><br>
            <p>:&nbsp;&nbsp;<?php echo $jual['produk_riwayat'] ?></p>
            <p>:&nbsp;&nbsp;<?php echo $jual['ukuran_riwayat'] ?></p>
            <p>:&nbsp;&nbsp;<?php echo $jual['warna_riwayat'] ?></p>
            <p>:&nbsp;&nbsp;<?php echo $jual['jumlah_riwayat'] ?></p>
            <p>:&nbsp;&nbsp;<?php echo $jual['metode_pembayaran'] ?></p>
            <p>:&nbsp;&nbsp;<?php echo $jual['ongkir_riwayat'] ?></p>
            <p>:&nbsp;&nbsp;<?php echo $jual['harga_riwayat'] ?></p>
            <p>:&nbsp;&nbsp;<?php echo $total ?></p>
            <p>:&nbsp;&nbsp;<?php echo $jual['tanggal']."&nbsp;|&nbsp;".$jual['waktu'];  ?> </p><br><br><br><br>
            <input type="hidden" name="email_customer" value="<?php echo $db_toko['email'] ?>">
            <div  class="text-end">
              <a href="cetak.php?menu=riwayat"  class="btn btn-primary">Download Struck</a>
            </div>
          </div>
        </div>
      </div>
      <hr class="m-0">
      <?php $no++; }}else{
         echo "<br>";
         echo "<div class='col-12 text-center ' style='margin-top:5rem;'>";
         echo "<h5 class='border w-50 p-3 bg-danger text-light rounded-3 ms-auto me-auto' role='alert'><i class='bi bi-exclamation-triangle-fill'></i>&nbsp;&nbsp;Tidak Ada Riwayat Tercatat</h5>";
         echo "</div>"; 
      } ?>
    </section> 

    <?php require_once('footer.php'); ?>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>