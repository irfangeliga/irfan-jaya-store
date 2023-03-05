<?php 
    require_once('../config.php');
    session_start();
    if(isset($_GET['id_pesanan'])){
        $id_pesanan = $_GET['id_pesanan'];
        $sql_hapus = "DELETE FROM pesanan where id_pesan = $id_pesanan";
        $query_hapus = mysqli_query($con, $sql_hapus);
    }

    function rupiah($angka){
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
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
    <title>List Pesanan | Halaman Admin</title>
</head>
<body>
   <div class="row ms-0 me-0">
        <div class="col-2">
           <?php require_once('navbar.php'); ?>
        </div>
        <div class="col-10 ">
            <div class="admin-head" style="margin-bottom:5rem;">
                <div class="text-center fs-1 fw-bold text-secondary mt-3 mb-3 ">List Pesanan Customer</div>
            </div>
            <div class="admin-body bg" style="height: 45rem;">
                <?php 
                    require_once('../config.php');
                    $no = 1;
                    $sql = "SELECT * FROM pesanan ORDER BY id_pesan desc";
                    $query = mysqli_query($con, $sql);
                    $row = mysqli_num_rows($query);
                    if($row == 0){
                ?>
                <div  class="alert alert-primary fs-3 text-center ms-auto me-auto" role="alert" style="top:40%;width:50%">
                    <p><i class="bi bi-emoji-neutral"></i>&nbsp;&nbsp;Tidak Ada Pesanan</p>
                </div>
                <?php }else{ ?>
                <div class="tabel ms-auto me-auto"><br>
                    <h3>Pesanan Customer Hari ini</h3>
                    <table class="table " style="height:33rem;">
                        <thead>
                            <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Nama Customer</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Ukuran </th>
                            <th scope="col">Warna </th>
                            <th scope="col">Jumlah </th>
                            <th scope="col">Total Harga </th>
                            <th scope="col">Tanggal Upload </th>
                            <th scope="col">Waktu Upload </th>
                            <th scope="col">Status </th>
                            <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($toko = mysqli_fetch_array($query)){
                                    $produk = $toko['foto'];
                                    $produk = explode("," , $produk);
                                    $harga_produk = ($toko['harga'] + $toko['ongkir']);

                                    $i=0;
                                    $nama = $toko['nama_pesan'];
                                    $nama = explode("," , $nama);
                                    $count2_nama = count($nama)-1;

                                    $ukuran = $toko['ukuran_pesan'];
                                    $ukuran = explode("," , $ukuran);
                                    $count2_ukuran = count($ukuran)-1;

                                    $warna = $toko['warna_pesan'];
                                    $warna = explode("," , $warna);
                                    $count2_warna = count($warna)-1;
                                    
                                    $jumlah = $toko['jumlah_pesan'];
                                    $jumlah = explode("," , $jumlah);
                                    $count2_jumlah = count($jumlah)-1;
                            ?>
                            <tr class="text-center" style="font-size:18px;">
                                <th scope="row"><?php echo $no ?></th>
                                <td class="text-center" style="width:170px;">
                                    <img src="../img/produk/<?php echo $produk[0]?>" alt="<?php echo $produk[0] ?>" style="width:100px;">
                                </td>
                                <td><?php echo $toko['nama_customer'] ?></td>
                                <td>
                                   <table class="border border-0">
                                        <?php  for($i=0;$i<=$count2_nama;++$i){ ?>
                                        <tr>
                                            <td>
                                                <?php echo $nama[$i] ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                   </table> 
                                </td>
                                <td style="width:100px;">
                                    <table class="border border-0">
                                        <?php  for($i=0;$i<=$count2_ukuran;++$i){ ?>
                                        <tr>
                                            <td>
                                                <?php echo $ukuran[$i] ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                   </table> 
                                </td>
                                <td style="width:100px;">
                                    <table class="border border-0">
                                        <?php  for($i=0;$i<=$count2_warna;++$i){ ?>
                                        <tr>
                                            <td>
                                                <?php echo $warna[$i] ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                   </table> 
                                </td>
                                <td class="text-center" style="width:100px;">
                                    <table class="border border-0">
                                        <?php  for($i=0;$i<=$count2_jumlah;++$i){ ?>
                                        <tr>
                                            <td>
                                                <?php echo $jumlah[$i] ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                   </table>
                                </td>
                                <td class="text-center"><?php echo rupiah($harga_produk) ?></td>
                                <td class="text-center"><?php echo $toko['tanggal'] ?></td>
                                <td class="text-center"><?php echo $toko['waktu'] ?></td>
                                <td style="width:240px;">
                                    <!-- jika tombol konfirmasi ditekan maka= -->
                                    <?php 
                                        if($toko['status'] == "Belum dibayar"){
                                            echo "<font color='red' class='fw-bold'>".$toko['status']."</font>";
                                        }else{
                                            echo "<font color='green' class='fw-bold'>".$toko['status']."</font>";
                                        }
                                    ?>
                                </td>
                                <td style="width:180px;">
                                <?php if($toko['status'] != "Belum dibayar"){ ?>
                                    <a href="list-pesanan.php?id_pesanan=<?php echo $toko['id_pesan'] ?>"  ><button disabled class="btn btn-danger rounded-1">Hapus</button></a>
                                <?php }else{ ?>
                                    <a href="list-pesanan.php?id_pesanan=<?php echo $toko['id_pesan'] ?>"  ><button  class="btn btn-danger rounded-1">Hapus</button></a>
                                <?php } ?>
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