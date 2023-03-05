<?php
require_once('config.php');
session_start();

function rupiah($angka){
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
}

?>
<!doctype html>
<html lang="en">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
    <title>Pencarian | Irfan Jaya</title>
  </head>
  <body style="height:100px;">
    <?php require_once('nav-cart.php');?>

    <!-- produk start -->
    <div class="produk" style="margin-top:5rem;"><br>
      <div class="text-center fw-bold text-dark" style="font-size:60px;">
        <font class="head-produk">IRFAN JAYA COLLECTION</font>
      </div><br>
      <div class="row ms-0 me-0">
        <div class="col-4"></div>
        <div class="col-4">
            <form action="" method="get" >
                <label for="keyword" class="fs-6 text-secondary text-uppercase mb-1">Temukan Yang Kau Suka</label><br>
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" name="keyword" id="keyword" aria-describedby="basic-addon1" autocomplete="off" autofocus>
                    <input type="submit" class=" btn btn-secondary" name="cari" value="Cari">
                </div>
            </form>
        </div>
        <div class="col-4"></div>
      </div><br><br>
      <div class="container text-center ">
        <div class="row rowme ">
          <?php 
            if(isset($_GET['cari'])){
              $i = "";
              $keyword = $_GET['keyword'];
              $sql_cari = "SELECT * FROM produk where nama_produk LIKE '%$keyword%' ORDER BY id_produk DESC";
              $query_cari = mysqli_query($con, $sql_cari);
            }else{
              $i = "";
              $sql_cari = "SELECT * FROM produk ORDER BY id_produk DESC";
              $query_cari = mysqli_query($con, $sql_cari);
            }
            $row = mysqli_num_rows($query_cari);
            if($row != 0){
            while($toko = mysqli_fetch_array($query_cari)){
            $foto = $toko['foto_produk'];
            $harga_produk = $toko['harga_produk'];
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
              <div class="card-body mt-2">
                <h5 class="card-title text-capitalize"><?php echo $toko['nama_produk'] ?></h5>
                <p class="card-text"><?php echo rupiah($harga_produk) ?></p>
                <?php 
                  echo "<a href='detail-produk.php?id=".$toko['id_produk']."' class='btn btn-primary' style='width:100%'>Detail Produk</a>";
                ?>
              </div>
            </div>
          </div>
          <?php }
          }else{
            echo "<div class='col-12 ' style='margin-top:5rem;'>";
            echo "<h5 class='border w-50 p-3 bg-danger text-light rounded-3 ms-auto me-auto' role='alert'><i class='bi bi-exclamation-triangle-fill'></i>&nbsp;&nbsp;Produk Tidak Ditemukan</h5>";
            echo "</div>"; } ?>
        </div><br>
      </div>
    </div><br><br><br>
  <!-- end produk -->

    <!-- footer -->
    <?php if($row != 0){
        require_once('footer.php'); 
    }else { ?>
    <div style="margin-top:13rem;">
    <?php require_once('footer.php'); ?>
    </div>
    <?php } ?>
    <!-- end footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>