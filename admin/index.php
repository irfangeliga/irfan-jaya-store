<?php 
    require_once('../config.php');
    session_start();
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
    <title>Halaman Admin | Irfan Jaya</title>
</head>
<body>
   <div class="row ms-0 me-0">
        <div class="col-2">
           <?php 
                require_once('navbar.php');
                $no = 1;
                $sql_data = "SELECT * FROM penjualan ORDER BY id_jual DESC";
                $query_data = mysqli_query($con, $sql_data);
                $row = mysqli_num_rows($query_data);
            ?>
        </div>
        <div class="col-10 ">
            <div class="admin-head " style="margin-bottom:7rem;">
                <div class="text-center fs-1 fw-bold text-secondary mt-3 mb-3 ">Selamat Datang di Halaman Admin Irfan Jaya</div>
                <!-- <div class="d-flex justify-content-center">
                    <div class="card m-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Total Pendapatan</h5>
                            <h6 class="card-subtitle mb-2 text-muted"></h6>
                        </div>
                    </div>
                    <div class="card m-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Total User</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                    <div class="card m-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Total User</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                    <div class="card m-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Total User</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="admin-body bg" style="height: 45rem;">
                <?php 
                    if($row == 0){
                ?>
                <div  class="alert alert-primary fs-3 text-center ms-auto me-auto" role="alert" style="top:40%;width:50%">
                    <p><i class="bi bi-emoji-neutral"></i>&nbsp;&nbsp; Belum Ada Penjualan</p>
                </div>
                <?php }else{ ?>
                <div class="tabel ms-auto me-auto"><br>
                    <h3>Laporan Penjualan Hari ini</h3>
                    
                    <table class="table table-striped text-center " style="height:33rem;">
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
                            <th scope="col">Pengiriman</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($jual = mysqli_fetch_array($query_data)){ 
                                  $i=0;
                                  $nama = $jual['nama_produk'];
                                  $nama = explode("," , $nama);
                                  $count2_nama = count($nama)-1;
          
                                  $ukuran = $jual['ukuran'];
                                  $ukuran = explode("," , $ukuran);
                                  $count2_ukuran = count($ukuran)-1;
          
                                  $warna = $jual['warna'];
                                  $warna = explode("," , $warna);
                                  $count2_warna = count($warna)-1;
                                  
                                  $jumlah = $jual['jumlah'];
                                  $jumlah = explode("," , $jumlah);
                                  $count2_jumlah = count($jumlah)-1;    
                            ?>
                                <tr >
                                    <th scope="row"><?php echo $no ?></th>
                                    <td>ijs00<?php echo $jual['id_jual'] ?></td>
                                    <td><?php echo $jual['nama_customer'] ?></td>
                                    <td><?php echo $jual['email_customer'] ?></td>
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
                                    <td style="width:60px;">
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
                                    <td style="width:60px;">
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
                                    <td style="width:60px;">
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
                                    <td class="text-capitalize"><?php echo $jual['kurir']." | ".$jual['detail']." | ".$jual['estimasi']." Hari" ?></td>
                                    <td><?php echo $jual['tanggal'] ?></td>
                                    <td><?php echo $jual['waktu'] ?></td>
                                </tr>
                            <?php
                                $no++; }
                            ?>
                        </tbody>
                    </table>
                <div>
                <!-- <div class="row text-primary">
                    <div class="col-3  ">
                        <div class="p-2">Total Pengunjung:</div>
                    </div>
                    <div class="col-3 ">
                        <div class="p-2">Total Pembeli:</div>
                    </div>
                    <div class="col-3 ">
                        <div class="p-2">Total Pembeli:</div>
                    </div>
                    <div class="col-3 ">
                        <div class="p-2">Total Pembeli:</div>
                    </div>
                </div> -->
                <div class="row mt-1 p-0 mt-5">
                    <div class="col-3 ms-auto text-end">
                    <a href="cetak.php?menu=data_jual" class="btn btn-success">Downoad Data Penjualan</a>
                    </div>
                </div>
                <?php } ?>
            </div><br>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>