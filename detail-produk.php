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
    <title>Detail Produk | Irfan Jaya</title>
  </head>
  <body>
    <!-- Detail Produk -->
    <?php 
      require_once('nav-cart.php');
    ?>
    <br><br><br><br>
    <div>
      <h1 class=" judul-detail">detail produk</h1><br><br>
      <div class="row ms-0 me-0">
        <div class="col-6">
          <?php require_once('image-slider.php'); ?>
        </div>
        <div class="col-6 ">
          <form action="" method="POST" class="form-user" id="inputForm" >
            <div class="atribut-produk "> 
              <input type="hidden" value="<?php echo $_SESSION['id'] ?>" name="id_user" >
              <input type="hidden" value="<?php echo $produk['id_produk'] ?>" name="id_produk" id="id_produk" >
              <input type="hidden" value="<?php echo $produk['nama_produk'] ?>" name="nama" id="nama" >
              <input type="hidden" value="<?php echo $produk['harga_produk'] ?>" name="harga" id="harga">
              <input type="hidden" value="<?php echo $produk['foto_produk'] ?>" name="foto" id="foto">
              <p class="fs-1 text-capitalize fw-bold text-primary "><?php echo $produk['nama_produk'] ?></p>
              <p class="fs-5">
                <?php
                  function rupiah($angka){
                    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
                    return $hasil_rupiah;
                  }
                  $harga_produk = $produk['harga_produk'];
                  $ukuran = $produk['ukuran_produk'];
                  $ukuran = explode("," , $ukuran);
                  $count = count($ukuran);
                  $count2 = count($ukuran)-1;

                  echo "<label for='ukuran'>Pilih Ukuran</label><br>";
                  echo "<select class='form-select border-dark text-uppercase' style='width:48%;' aria-label='Default select example' name='ukuran' id='ukuran'>";
                    for($i=0;$i<=$count2;++$i){
                      echo "<option>".$ukuran[$i]."</option>";
                    }
                  echo "</select>";
                ?>
              </p>
              <p class="fs-5">
                <?php 
                  $warna = $produk['warna_produk'];
                  $warna = explode("," , $warna);
                  $count_warna  = count($warna);
                  $count2_warna = count($warna)-1;
                  echo "<label for='warna'>Pilih Warna</label><br>";
                  echo "<select class='form-select border-dark text-uppercase' style='width:48%;' aria-label='Default select example' name='warna' id='warna'>";
                    for($i=0;$i<=$count2_warna;++$i){
                      echo "<option>".$warna[$i]."</option>";
                    }
                  echo "</select>";
                ?>
              </p>
              <font class="fs-5 " value="<?php echo $produk['stok_produk'] ?>" name="stok">Stok:&nbsp; <?php echo $produk['stok_produk'] ?></font><br>
              <label for="kuantitas">Mau berapa</label>&nbsp;&nbsp;&nbsp;
              <input type="number" name="kuantitas" class="border-dark rounded" id="kuantitas" value="1" ><br><br>
              <font class="fs-2 text-capitalize fw-bold" style="color:red;" name="harga" id="harga" value="<?php echo $produk['harga_produk'] ?>"><?php echo rupiah($harga_produk) ?></font><br><br>
              
              <div class="btn-detail">
                <?php if(isset($_SESSION['web'])){ ?>
                <button class="klik-cart form-control btn-item2"  type="button">Tambah Ke Keranjang</button>
                <button type="button" class="form-control btn-item klik-beli" >Beli Sekarang</button>
                <?php }else{ ?>
                <a href="login.php" class="text-decoration-none"><button type="button" class=" form-control btn-item" >LOGIN</button></a>
                <?php } ?>
                </div><br><br>
                <h5><b><i>Deskripsi Produk</i></b></h5>
                <p class="text-lowercase"><?php echo $produk['deskripsi_produk'] ?></p>
              </div>
          </form>
        </div>
      </div>
    </div>
    <!-- end Detail Produk -->
    <script type="text/javascript">
      $(document).ready(function(){
        $('.klik-cart').click(function(){
          var data =$('.form-user').serialize();
          $.ajax({
            type:'POST',
            url:'cart-master.php?menu=cart&act=input',
            data:data,
            success:function(){
              location.reload();
            },
          });
        });
      });

      $(document).ready(function(){
        $('.klik-beli').click(function(){
          var data =$('.form-user').serialize();
       
            var nama =document.getElementById("nama").value;
            var foto =document.getElementById("foto").value;
            var ukuran =document.getElementById("ukuran").value;
            var warna =document.getElementById("warna").value;
            var kuantitas =document.getElementById("kuantitas").value;
            var harga =document.getElementById("harga").value;  
            var id_produk =document.getElementById("id_produk").value; 
            window.location.href = "detail-beli.php?nama="+nama+"&foto="+foto+"&ukuran="+ukuran+"&warna="+warna+"&kuantitas="+kuantitas+"&harga="+harga+"&id_produk="+id_produk;
        });
      });
    </script>
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>