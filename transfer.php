<?php
require_once('config.php');
session_start();

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
    <title>Profil Saya | Irfan Jaya</title>
</head>
<body>
    <!-- Modal -->
    <div class="modal fade"  id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered modal-lg" >
            <div class="modal-content " >
                <div class="modal-header">
                <h4 class="text-end text-secondary text-uppercase" id="exampleModalLabel">Informasi Pembayaran</h4>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body" >
                    <p class="text-start text-capitalize fs-6 text-primary" id="exampleModalLabel">silahkan lakukan pembayaran ke nomor rekening: <b>BRI - 0813 33223 32323 3232323.</b> dengan mengikuti petunjuk dibawah!!</p>
                    <font><b>Transfer Melalui BRImo</b></font>
                    <ul>
                        <li>Login aplikasi BRImo</li>
                        <li>Pilih menu “Transfer” dan pilih “Tambah Daftar Baru” </li> 
                        <li>Pilih Bank Tujuan dan Pilih Metode “Transfer BI-Fast”</li>
                        <li>Masukkan nomor rekening tujuan atau masukkan email / nomor handphone tujuan yang terdaftar BI-Fast </li>
                        <li>Pilih rekening sumber yang akan digunakan Konfirmasi transaksi dan masukkan PIN </li>
                        <li>Transaksi berhasil</li>
                        <li>kirim bukti foto/screenshoot transaksi pada menu <b>Pesanan</b> di navbar Irfan Jaya</li>
                    </ul>
                    <font><b>Transfer Melalui ATM</b></font>
                    <ul>
                        <li>Masukkan kartu debit ke mesin ATM</li>
                        <li>Pilih bahasa</li>
                        <li>Masukkan nomor PIN</li>
                        <li>Pilih menu transfer</li>
                        <li>Pilih tujuan transfer: antarrekening atau antarbank</li>
                        <li>Masukkan kode Bank beserta nomor rekening tujuan jika memilih transfer antarbank</li>
                        <li>Masukkan nominal transfer</li>
                        <li>Cek kembali informasi transfer</li>
                        <li>Konfirmasi dengan memilih “YA” atau “YES”</li>
                        <li>Ambil dan simpan struk ATM sebagai bukti transfer uang</li>
                        <li>kirim bukti foto/screenshoot transaksi pada menu <b>Pesanan</b> di navbar Irfan Jaya</li>
                    </ul>

                    <P class="text-danger fs-6 ps-3 pe-3" style="text-align:justify;"> 
                        <font class="fs-5">Catatan:</font> 
                        Jika pembayaran tidak dilakukan dalam kurun waktu 24 jam setelah pesanan dilakukan, maka produk yang telah dipesan dianggap telah dibatalkan. <b>Notifikasi Berhasil dan gagalnya pembayaran akan dikirim ke email Anda</b>
                    </P>
                </div>
                <div class="modal-footer">
                    <a type="button" href="index.php"  class="btn btn-primary form-control">OK</a>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->

    <script type="text/javascript">
        window.onload = function () {
        OpenBootstrapPopup();
    };
    function OpenBootstrapPopup() {
        $("#exampleModal1").modal('show');
    }
    
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
