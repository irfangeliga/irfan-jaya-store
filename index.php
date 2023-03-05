<?php
require_once('config.php');
session_start();

?>
<!doctype html>
<html lang="en">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
    <title>Irfan Jaya | Toko Pakaian</title>
  </head>
  <body>
    <?php require_once('nav-cart.php'); ?>
    <!-- cover start -->
      <br><br><br>
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="1500">
            <img src="img/banner_real3.png" class="d-block w-100 img-cover" alt="banner_real3.png">
          </div>
          <div class="carousel-item" >
            <img src="img/banner_real2.png" class="d-block w-100 img-cover" alt="banner_real3.png">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    <!-- end cover -->
    <!-- produk start -->
    <div class="produk "><br>
      <div class="text-center fw-bold text-dark fs-1 ">
        <font class="head-produk">NEW PRODUCT</font>
      </div><br>
      <div class="container text-center ">
        <div class="row rowme ">
          <?php 
            $i = "";
            $sql = "SELECT * FROM produk ORDER BY id_produk DESC limit 6";
            $query = mysqli_query($con, $sql);

            function rupiah($angka){
              $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
              return $hasil_rupiah;
            }

            while($toko = mysqli_fetch_array($query)){
             $harga = $toko['harga_produk'];
          ?>
          <div class="col-4 column">
            <div class="card card-produk me-auto ms-auto" >
              <?php 
                 $produk = $toko['foto_produk'];
                 echo "<input type='hidden' value='".$produk."' name='foto'>";
                 $produk = explode("," , $produk);
                 $count = count($produk);
                 if($count > 1){
                   $count2 = count($produk)-1;
                   echo "<img src='img/produk/".$produk[0]."' class='card-img-top img-produk' alt='".$toko['nama_produk']."'>";
                 
                  } else{
                   echo "<img src='img/produk/".$toko['foto_produk']."' class='card-img-top img-produk' alt='".$toko['nama_produk']."'>";
                 }
              ?>
              <!-- <img src="img/produk/<?php echo $produk[$i]?>" class="card-img-top img-produk" alt="..."> -->
              <div class="card-body mt-2">
                <h5 class="card-title text-capitalize"><?php echo $toko['nama_produk'] ?></h5>
                <p class="card-text"><?php echo rupiah($harga) ?></p>
                <?php 
                  echo "<a href='detail-produk.php?id=".$toko['id_produk']."' class='btn btn-primary' style='width:100%'>Detail Produk</a>";
                ?>
              </div>
            </div>
          </div>
           <?php } ?>
        </div>
        <a href="produk.php">
          <button type="button" class="btn-more btn pe-5 ps-5" >LIHAT LEBIH BANYAK</button>
        </a>
        <br><br>
      </div>
    </div><br><br>
  <!-- end produk -->

    <!-- footer -->
    <?php require_once('footer.php'); ?>
    <!-- end footer -->


    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>