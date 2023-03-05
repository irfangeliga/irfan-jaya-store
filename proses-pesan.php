<?php 
    require_once('config.php');
    if(isset($_POST['pesan'])){
        $nama_customer = $_POST['nama_customer'];
        $id_customer = $_POST['id_customer'];
        $status = "Belum dibayar";
        $metode = $_POST['metode_bayar'];
        $ongkir  = $_POST['ongkir'];
        $harga_cart  = $_POST['total'];
        $detail = $_POST['detail'];
        $estimasi = $_POST['estimasi'];
        $kurir = $_POST['kurir'];

        if(isset($_POST['nama'])){
            $id_cart   = implode(",", $_POST['id']);
            $nama_cart   = implode(",", $_POST['nama']);
            $foto_cart   = implode(",", $_POST['foto']);
            $ukuran_cart =implode(",", $_POST['ukuran']);
            $warna_cart  =implode(",", $_POST['warna']);
            $jumlah_cart =implode(",", $_POST['jumlah']);
            $id_cart = explode("," , $id_cart);
            foreach($id_cart as $value){
                $sql_hapus = mysqli_query($con,"DELETE FROM keranjang where id_keranjang = $value");
            }
        }

        if(isset($_POST['nama_cart'])){
            $nama_cart = $_POST['nama_cart'];
            $foto_cart   = $_POST['foto_cart'];
            $ukuran_cart = $_POST['ukuran_cart'];
            $warna_cart  = $_POST['warna_cart'];
            $jumlah_cart   = $_POST['jumlah_cart'];
        }

        $sql = "INSERT INTO pesanan ( nama_pesan, ukuran_pesan, warna_pesan, jumlah_pesan, harga, foto, status, tanggal, waktu, nama_customer, id_customer, ongkir, metode, estimasi, detail, kurir) VALUE 
                ( '$nama_cart', '$ukuran_cart', '$warna_cart','$jumlah_cart', '$harga_cart', '$foto_cart', '$status', DATE_FORMAT(CURDATE(),'%d-%m-%Y'), now(), '$nama_customer', $id_customer, $ongkir, '$metode', '$estimasi', '$detail', '$kurir')";
        $query = mysqli_query($con, $sql);

        if( $query ) {
            echo " <script> 
                    alert('Produk Berhasil dipesan');
                    document.location.href = 'transfer.php';
                    </script>";
        } else {
            echo " <script> 
                    alert('Produk Gagal ditambahkan');
                    document.location.href = 'detail-beli.php';
                    </script>";
        }
    }
    if (isset($_GET['menu'])) {
            $menu = $_GET['menu'];
            $alamat_update = $_POST['alamat_ubah'];
            $id_update = $_POST['id_update']; 
            $sql = "UPDATE users SET alamat = '$alamat_update' WHERE id=$id_update";
            $query = mysqli_query($con, $sql);
        }
    
?>