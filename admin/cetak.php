<?php 
session_start();
if(!isset($_SESSION['adminijs'])){
    header('location: ../login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
    <title>Cetak Dokumen | Halaman Admin</title>
</head>
<style>
    .tbl_cetak{
        width: 70rem;
    }
    td{
        width: 300px;
    }

</style>
<body>
   <?php 
   if($_GET['menu']){
    require_once('../config.php'); 
    $no = 1;
    $sql_user = "SELECT * FROM users";
    $query_user = mysqli_query($con, $sql_user);

    $sql_jual = "SELECT * FROM penjualan";
    $query_jual = mysqli_query($con, $sql_jual);
   }
    
    if($_GET['menu'] == "data_user"){
   ?>
    <div class="tbl_cetak ms-auto me-auto"><br>
        <h3>Customer Terdaftar</h3>
        <table class="table table-hover me-5" style="height:auto;">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Customer</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Alamat</th>
                <th scope="col">Foto</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                   while($user = mysqli_fetch_array($query_user)){ ?>
                    <tr>
                    <th scope="row"><?php echo $no ?></th>
                    <td><?php echo $user['name'] ?></td>
                    <td><?php echo $user['username'] ?></td>
                    <td>@<?php echo $user['email'] ?></td>
                    <td><?php echo "alamat"?></td>
                    <td><?php echo $user['photo'] ?></td>
                </tr>
                <?php
                    $no++; }
                ?>
            </tbody>
        </table>
    <div>
    
    <div class="row mt-4 p-0">
        <div class="col-3 ms-auto me-5 text-end">
            <a href="" onclick="print()" >Downoad Data Customer</a>
        </div>
    </div>
    <?php }elseif($_GET['menu'] ==  "data_jual"){ ?>
        <div class="tbl_cetak ms-auto me-auto"><br>
        <h3>Customer Terdaftar</h3>
        <table class="table table-hover me-5" style="height:auto;">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">kode penjualan</th>
                    <th scope="col">Nama Customer</th>
                    <th scope="col">Email Customer</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Ukuran</th>
                    <th scope="col">Warna</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php while($penjualan = mysqli_fetch_array($query_jual)){ ?>
                <tr>
                    <th scope="row"><?php echo $no ?></th>
                    <td>ijs00<?php echo $penjualan['id_jual'] ?></td>
                    <td><?php echo $penjualan['nama_customer'] ?></td>
                    <td>@<?php echo $penjualan['email_customer'] ?>mdo</td>
                    <td><?php echo $penjualan['nama_produk'] ?></td>
                    <td style="width:60px;"><?php echo $penjualan['ukuran'] ?></td>
                    <td style="width:60px;"><?php echo $penjualan['warna'] ?></td>
                    <td style="width:60px;"><?php echo $penjualan['jumlah'] ?></td>
                    <td><?php echo $penjualan['tanggal'] ?></td>
                    <td><?php echo $penjualan['waktu'] ?></td>
                </tr>
                <?php
                    $no++; }
                ?>
            </tbody>
        </table>
    <div>
    
    <div class="row mt-4 p-0">
        <div class="col-3 ms-auto me-5 text-end">
            <a href="" onclick="print()" >Downoad Data Customer</a>
        </div>
    </div>
    <?php  } ?>
    <script type="text/javascript">
         function printPage() {
            window.print();
            
            }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>