<?php 
include('config.php');
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

if(isset($_GET['menu'])){
$menu = $_GET['menu'];
$act = $_GET['act'];
// cek apakah tombol daftar sudah diklik atau blum?
if($menu == "cart" && $act == "input"){
    $nama = $_POST['nama'];
    $id_produk = $_POST['id_produk'];
    $id_user = $_POST['id_user'];
    $kuantitas = $_POST['kuantitas'];
    $ukuran = $_POST['ukuran'];
    $harga = $_POST['harga'];
    $foto = $_POST['foto'];
    $warna = $_POST['warna'];

    $query = "INSERT INTO keranjang (nama, id_produk, id_user, jumlah, ukuran, harga, foto, warna) VALUE ('$nama','$id_produk','$id_user','$kuantitas','$ukuran','$harga','$foto','$warna')";
    $result = mysqli_query($con, $query);
    }
}

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    
    $sql = "DELETE FROM keranjang WHERE id_keranjang = $id";
    $query = mysqli_query($con, $sql);

    
    }
    
?>