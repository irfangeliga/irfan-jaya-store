<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
    <title>Konfirmasi Pembayaran | Halaman Admin</title>
</head>
<style>
    #portfolio .portfolio-item .portfolio-link {
  position: relative;
  display: block;
  margin: 0 auto;
  border: 1px solid rgba(255, 200, 0, 0.9);
  border-radius: 3px;
}
#portfolio .portfolio-item .portfolio-link .portfolio-hover {
  display: flex;
  position: absolute;
  width: 100%;
  height: 100%;
  background: gray;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity ease-in-out 0.25;
}
#portfolio .portfolio-item .portfolio-link:hover .portfolio-hover {
  background-color: rgb(0, 0, 0,0.6);
  opacity: 80%;
}
</style>
<body>
    <div class="row ms-0 me-0">
        <div class="col-2">
           <?php 
           require_once('../config.php');
           session_start();
            require_once('navbar.php'); 

            function rupiah($angka){
                $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
                return $hasil_rupiah;
              }
           ?>
        </div>
        <div class="col-10 ">
            <div class="admin-head" style="margin-bottom:5rem;">
                <div class="text-center fs-1 fw-bold text-secondary mt-3 mb-3 ">Data Bukti Transaksi</div>
            </div>
            <div class="admin-body bg" style="height: 45rem;">
                <?php 
                    $no = 1;
                    $sql = "SELECT * FROM bukti ORDER BY id_bukti desc";
                    $query = mysqli_query($con, $sql);

                    if(mysqli_num_rows($query) == 0){
                ?>
                <div  class="alert alert-primary fs-3 text-center ms-auto me-auto" role="alert" style="top:40%;width:50%">
                    <p><i class="bi bi-emoji-neutral"></i>&nbsp;&nbsp;Tidak Ada Transaksi Yang dikirim</p>
                </div>

                <?php }else{ ?>
                <form action="" method="post" class="form-gagal">
                    <div class="tabel ms-auto me-auto"><br>
                        <h3>Tabel Konfirmasi Pembayaran</h3>
                        <p>Silahkan Konfirmasi Transaksi Customer dengan memilih tombol Berhasil/Gagal</p>
                        <table class="table " style="height:33rem;">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Bukti</th>
                                    <th scope="col">Nama Customer</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Kode Pemesanan</th>
                                    <th scope="col">Total Pembayaran</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Konfirmasi Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while($konfirmasi = mysqli_fetch_array($query)){
                                        $harga_produk = $konfirmasi['total_pembayaran'];
                                ?>
                                <tr class="text-center" style="font-size:18px;">
                                    <th scope="row"><?php echo $no ?></th>
                                    <td style="width:120px;">
                                        <div id="portfolio">
                                            <div class="portfolio-item">
                                                <a class="btn_bukti border-0 rounded-0 portfolio-link" type="button" data-bs-toggle="modal" data-bs-target="#Modal<?php echo $konfirmasi['id_bukti'] ?>">
                                                    <div class="portfolio-hover">
                                                        <div class="portfolio-hover-content">
                                                            <i class="bi bi-eye text-light fst-normal">&nbsp;Klik</i>
                                                        </div>
                                                    </div>
                                                    <img src="../img/bukti-tf/<?php echo $konfirmasi['image'] ?>" alt="<?php echo $konfirmasi['image'] ?>" width="100px">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="modal fade " id="Modal<?php echo $konfirmasi['id_bukti'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered ">
                                                <div class="modal-content">
                                                    <img src="../img/bukti-tf/<?php echo $konfirmasi['image'] ?>" alt="<?php echo $konfirmasi['image'] ?>" >
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?php echo $konfirmasi['nama_customer'] ?></td>
                                    <td><?php echo $konfirmasi['email_customer'] ?></td>
                                    <td style="width:150px">TIJKP00<?php echo $konfirmasi['id_pesan'] ?></td>
                                    <td style="width:150px"><?php echo rupiah($harga_produk)?></td>
                                    <td style="width:100px"><?php echo $konfirmasi['tanggal'] ?></td>
                                    <td style="width:100px"><?php echo $konfirmasi['waktu'] ?></td>
                                    <td style="width:23rem" class="text-center">
                                        <button  type="button" onclick="berhasil(<?php echo $konfirmasi['id_bukti'] ?>)" class="btn btn-success rounded-1">Berhasil</button>&nbsp;&nbsp;
                                        <button type="button" onclick="gagal(<?php echo $konfirmasi['id_bukti'] ?>)" class="btn btn-warning rounded-1">Gagal</button>&nbsp;&nbsp;
                                        <button type="button" onclick="hapus(<?php echo $konfirmasi['id_bukti'] ?>)" class="btn btn-danger rounded-1">Hapus</button>
                                    </td>
                                </tr>
                                <?php $no++; } ?>
                            </tbody>
                        </table>
                    <div>
                </form> 
                <div class="row mt-1 p-0">
                    <div class="col-3 ms-auto text-end">
                        <div class="btn btn-success">Downoad Laporan</div>
                    </div>
                </div>
                <?php } ?>
            </div><br>
        </div>
    </div>
    
    <script type="text/javascript">
        function gagal(id){
            $.ajax({
                type:'POST',
                url:'../email/kirim.php?id_bukti='+id+'&act=gagal',
                success:function(){
                location.reload();
                alert("Pemberitahun Pembayaran Gagal Telah dikirim ke email Customer");
                },
            });
        }
        function berhasil(id){
            $.ajax({
                type:'POST',
                url:'../email/kirim.php?id_bukti='+id+'&act=sukses',
                success:function(){
                location.reload();
                alert("Pemberitahun Pembayaran Berhasil Telah dikirim ke email Customer");
                },
            });
        }
        function hapus(id){
            $.ajax({
                type:'POST',
                url:'../email/kirim.php?id_bukti='+id+'&act=hapus',
                success:function(){
                    location.reload();
                    alert("Data Berhasil dihapus");
                },
            });
        }
           
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>