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

  if(isset($_POST['kirim-bukti'])){
    $nama_customer = $_POST['nama_customer'];
    $id_customer = $_POST['id_customer'];
    $id_pesan = $_POST['id_pesan'];
    $email = $_POST['email_customer'];
    $harga = $_POST['total_harga'];
    $direktori = "./img/bukti-tf/";
    $file_name = $_FILES['bukti']['name'];
    move_uploaded_file($_FILES['bukti']['tmp_name'],$direktori.$file_name);
    
    $sql = "INSERT INTO bukti ( id_customer,id_pesan, nama_customer, email_customer, total_pembayaran, image, tanggal, waktu) VALUE ('$id_customer','$id_pesan', '$nama_customer', '$email', $harga, '$file_name', DATE_FORMAT(CURDATE(),'%d-%m-%y'), now())";
    $query = mysqli_query($con, $sql);

    if( $query ) {
        echo " <script> 
                alert('Bukti Pembayaran Berhasil dikirim');
                document.location.href = 'index.php';
                </script>";
      } else {
          echo " <script> 
                  alert('Bukti Pembayaran Gagal dikirim');
                  document.location.href = 'chat-pesanan.php';
                  </script>";
      }
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
    <title>Pesanan Saya | Irfan Jaya</title>
  </head>
  <body>
    <?php require_once('nav-cart.php');?>
    <br><br><br>
    <h1 class="p-4 ">Terima Kasih Telah melakukan Pemesanan di Irfan Jaya Store</h1>

    <?php 
       $no = 1;
       $query_pesan = "SELECT * FROM pesanan where id_customer = '$id' ORDER BY id_pesan DESC";
       $sql_pesan = mysqli_query($con,$query_pesan);
       $row = mysqli_num_rows($sql_pesan);
       
    ?>
    <div class="text-start ms-3 mb-3">
      <a href="transfer.php">
        <i class="bi bi-box-arrow-up-right"></i>
        &nbsp;&nbsp;Klik untuk Petunjuk Pembayaran
      </a> 
    </div>
    <section style="margin-bottom:27.7rem;">
    <div class="row text-center ms-0 me-0">
      <div class="col-1 border" style="width:50px;">
        &nbsp;&nbsp;&nbsp;No.
      </div>
      <div class="col-1 border">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Foto
      </div>
      <div class="col-2 border">Produk
      </div>
      <div class="col-2 border">
        Total Harg
      </div>
      <div class="col-2 border">tujuan transfe</div>
      <div class="col-2 text-end border-top">
        Fitur Upload
      </div>
      <div class="col-1  border-top">
      </div>
      <div class="col-1 border " style="width:16.7rem;">
        Status Pesanan
      </div>
    </div>
    <?php if($row != 0 ){
      while($pesan = mysqli_fetch_array($sql_pesan)){ 
        $total = 0;
        $foto = $pesan['foto'];
        $harga = ($pesan['harga']+$pesan['ongkir']);
        $jumlah = $pesan['jumlah_pesan'];
        $foto = explode("," , $foto);
        
       $hidden = "hidden";
       if($pesan['status'] != "Belum dibayar"){
        echo "<div hidden>";
       }else{
        echo "<div>";
       }
    ?>
      <hr class="m-0">
        <div class="p-4 chat-body">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="row text-center ms-0 me-0">
              <div class="col-1" style="width:50px;">
                <?php echo $no."." ?>
              </div>
              <div class="col-1">
                
                <img src="img/produk/<?php echo $foto[0] ?>" alt="<?php echo $pesan['foto'] ?>" style="width:8rem;hight:10rem;"> 

              </div>
              <div class="col-2">
                <?php 
                  $produk = $pesan['nama_pesan'] ;
                  $produk = explode("," , $produk);
                  foreach($produk as $value){
                      echo "<font>".$value.", </font>";
                  }
                ?>
              </div>
              <div class="col-2">
                <?php 
                  echo "<p>".rupiah($harga)."</p>"
                ?>
              </div>
              <div class="col-2">BRI - 0813 33223 32323 3232323</div>
              <div class="col-2 text-start ">
                <p>Silahkan Kirim Bukti Transfer Anda untuk kode pemesanan <b>(TIJKP00<?php echo $pesan['id_pesan'] ?>)</b>&nbsp;&nbsp; pada form dibawah</p>
                <input type="file" name="bukti" class="border border-dark rounded-1 form-control form-control-sm"  autofocus multiple required>
              </div>
              <div class="col-1  mt-3">
                <input type="hidden" name="id_customer" value="<?php echo $db_toko['id'] ?>">
                <input type="hidden" name="nama_customer" value="<?php echo $db_toko['name'] ?>">
                <input type="hidden" name="id_pesan" value="<?php echo $pesan['id_pesan'] ?>">
                <input type="hidden" name="email_customer" value="<?php echo $db_toko['email'] ?>">
                <input type="hidden" name="total_harga" value="<?php echo $harga ?>"><br><br>
                <button type="submit" class="btn btn-primary pt-1 pb-1 pe-4 ps-4 rounded-1 mt-4" style="bottom:0;" name="kirim-bukti">Kirim</button>
              </div>
              <div class="col-1 text-end mt-4 fs-5 text-danger ">
                <br>
                <?php 
                    if($pesan['status'] == "Belum dibayar"){
                        echo "<font color='red' class='fw-bold'>".$pesan['status']."</font>";
                    }else{
                        echo "<font color='green' class='fw-bold'>".$pesan['status']."</font>";
                    }
                ?>
              </div>
            </div>
          </form>
        </div>
      <hr class="m-0">
    </div>
      <?php $no++; }} else{
        echo "<br>";
        echo "<div class='col-12 text-center ' style='margin-top:5rem;'>";
        echo "<h5 class='border w-50 p-3 bg-danger text-light rounded-3 ms-auto me-auto' role='alert'><i class='bi bi-exclamation-triangle-fill'></i>&nbsp;&nbsp;Tidak Ada Pesanan yang dilakukan</h5>";
        echo "</div>"; 
      } ?>
    </section> 

    <?php require_once('footer.php'); ?>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>