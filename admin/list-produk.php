<?php 
    require_once('../config.php');
    session_start();
    if(isset($_GET['id_produk'])){
        $id_produk = $_GET['id_produk'];
        $sql_hapus = "DELETE FROM produk where id_produk = $id_produk";
        $query_hapus = mysqli_query($con, $sql_hapus);

        if($query_hapus){
            echo "<script>
                    alert('Produk Berhasil dihapus');
                </script>";
        }
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
    <title>List Produk | Halaman Admin</title>
</head>
<body>
   <div class="row ms-0 me-0">
        <div class="col-2">
           <?php require_once('navbar.php'); ?>
        </div>
        <div class="col-10 ">
            <div class="admin-head" style="margin-bottom:6rem;">
                <div class="text-center fs-1 fw-bold text-secondary mt-3 mb-3 ">List Produk Irfan Jaya</div>
            </div>
            <div class="admin-body bg" style="height: 45rem;">
            <?php 
                 require_once('../config.php');
                 $no = 1;
                 $sql = "SELECT * FROM produk ORDER BY id_produk desc";
                 $query = mysqli_query($con, $sql);
                 $row = mysqli_num_rows($query);

                 function rupiah($angka){
                     $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
                     return $hasil_rupiah;
                 }

                 if($row == 0){
            ?>
                <div class="alert alert-primary fs-3 text-center ms-auto me-auto" role="alert" style="top:40%;width:50%">
                    <p><i class="bi bi-emoji-neutral"></i>&nbsp;&nbsp;Tidak Ada Produk yang diposting</p>
                </div>
                <?php }else{ ?>
                <div class="tabel ms-auto me-auto"><br>
                    <h3>List Produk yang diposting </h3>
                <div id="demo"></div>
                    <table class="table " style="height:34rem;">
                        <thead>
                            <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Ukuran </th>
                            <th scope="col">Warna </th>
                            <th scope="col">Stok </th>
                            <th scope="col">Harga </th>
                            <th scope="col">Tanggal Upload </th>
                            <th scope="col">Waktu Upload </th>
                            <th scope="col">Tindakan </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                               
                    
                                while($toko = mysqli_fetch_array($query)){
                                    $produk = $toko['foto_produk'];
                                    $produk = explode("," , $produk);
                                    $harga = $toko['harga_produk'];
                            ?>
                            <tr class="text-center" style="font-size:18px;">
                            <th scope="row"><?php echo $no ?></th>
                            <td class="text-center" style="width:170px;"><img src="../img/produk/<?php echo $produk[0]?>" alt="<?php echo $produk[0] ?>" style="width:100px;"></td>
                            <td><?php echo $toko['nama_produk'] ?></td>
                            <td><?php echo $toko['ukuran_produk'] ?></td>
                            <td><?php echo $toko['warna_produk'] ?></td>
                            <td class="text-center"><?php echo $toko['stok_produk'] ?></td>
                            <td  class="text-center"><?php echo rupiah($harga) ?></td>
                            <td class="text-center"><?php echo $toko['tanggal'] ?></td>
                            <td class="text-center"><?php echo $toko['waktu'] ?></td>
                            <td>
                                <a href="edit-produk.php?id_produk=<?php echo $toko['id_produk'] ?>"><button class="btn btn-primary">Edit</button></a>
                                <a href="list-produk.php?id_produk=<?php echo $toko['id_produk'] ?>"><button class="btn btn-danger">Hapus</button></a>
                            </td>
                            </tr>
                            <?php $no++; } ?>
                        </tbody>
                    </table>
                <div>
                <div class="row mt-1 p-0 mt-5">
                    <div class="col-3 ms-auto text-end">
                        <div class="btn btn-success">Downoad Laporan</div>
                    </div>
                </div>
                <?php } ?>
            </div><br>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>