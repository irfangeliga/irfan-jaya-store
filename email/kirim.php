<?php
        // $tujuan=$_POST['tujuan'];
        // $subjek=$_POST['subjek'];
        // $pesan=$_POST['pesan'];
        if(isset($_GET['id_bukti'])){
            
            require_once('../config.php');
            $id_bukti= $_GET['id_bukti'];

            $sql = "SELECT * FROM bukti where id_bukti = $id_bukti";
            $query = mysqli_query($con, $sql);
            $result = mysqli_fetch_assoc($query);
            $id_pesan = $result['id_pesan'];
            $tb_bukti = $result['id_bukti'];
            $id_userjual = $result['id_customer'];
            $id_pesanjual = $result['id_pesan'];
            $id_produkjual = $result['id_produk'];

            $sql_user = "SELECT * FROM users where id = $id_userjual";
            $query_user = mysqli_query($con, $sql_user);
            $result_user = mysqli_fetch_assoc($query_user);
            $nama_customer = $result_user['name'];
            $email_customer = $result_user['email'];

            $sql_pesanan = "SELECT * FROM pesanan where id_pesan = $id_pesanjual";
            $query_pesanan = mysqli_query($con, $sql_pesanan);
            $result_pesanan = mysqli_fetch_assoc($query_pesanan);

            $nama_produk = $result_pesanan['nama_pesan'];
            $ukuran = $result_pesanan['ukuran_pesan'];
            $warna = $result_pesanan['warna_pesan'];
            $jumlah = $result_pesanan['jumlah_pesan'];
            $harga = $result_pesanan['harga'];
            $ongkir = $result_pesanan['ongkir'];
            $metode = $result_pesanan['metode'];
            $kurir = $result_pesanan['kurir'];
            $estimasi = $result_pesanan['estimasi'];
            $detail = $result_pesanan['detail'];

            if($_GET['act'] == "gagal"){
              $kode_pesan = $result['id_pesan'];
              $tujuan     = $result['email_customer'];
              $subjek     ="Konfirmasi Pembayaran";
              $pesan      = "<h1>Terima Kasih Telah Berbelanja di Irfan Jaya Store</h1><h4>Mohon maaf!! </h4><p>
              Transaksi melalui transfer-Bank BRI dengan kode pemesanan TIJKP00".$kode_pesan." dinyatakan gagal. Silahkan melakukan transaksi kembali dan kirimkan bukti pada Laman website Irfan jaya -> menu profil pada navbar -> Pesnanan.<br> pesanan akan otomatis dibatalkan jika pembayaran tidak dilakukan dalam jangka waktu 1x24 jam yang dihitung sesaat setelah dilakukan pemesanan.</p>";
            }
            elseif($_GET['act'] == "sukses"){
              $kode_pesan = $result['id_pesan'];
              $status = "Pembayaran Berhasil";
              $tujuan     = $result['email_customer'];
              $subjek     ="Konfirmasi Pembayaran";
              $pesan      = "<h1>Terima Kasih Telah Berbelanja di Irfan Jaya Store</h1><h3>Pembayaran Berhasil dilakukan</h3><p>
              Transaksi melalui transfer-Bank BRI dengan kode pemesanan TIJKP00".$kode_pesan." Sukses. Barang yang telah dipesan akan dikirim kealamat yang telah diisikan pada saat memesan di website Irfan Jaya.<br> dibawah ini kami lampirkan invoice belanja yang telahdilakukan. <br> <h3>Semoga Hari Anda Menyenangkan</h3>";


              $sql_update = "UPDATE pesanan SET status = '$status' where id_pesan = $id_pesan";
              $query_update = mysqli_query($con, $sql_update);

              $sql_update2 = "UPDATE pesanan SET status = '$status' where id_pesan = $id_pesan";
              $query_update2 = mysqli_query($con, $sql_update2);

              $sql_insert = "INSERT INTO penjualan (id_user, id_pesan, nama_customer, email_customer, nama_produk, ukuran, warna, jumlah, tanggal, waktu, kurir, estimasi, detail) VALUE 
              ('$id_userjual', '$id_pesanjual', '$nama_customer','$email_customer', '$nama_produk','$ukuran', '$warna', '$jumlah', DATE_FORMAT(CURDATE(),'%d-%m-%Y'), now(), '$kurir', '$estimasi', '$detail')";
              $query_insert = mysqli_query($con, $sql_insert);

              $sql_insert2 = "INSERT INTO riwayat (produk_riwayat, ukuran_riwayat, warna_riwayat, jumlah_riwayat, ongkir_riwayat, harga_riwayat, metode_pembayaran, tanggal, waktu, id_user, id_pesan) VALUE 
              ('$nama_produk', '$ukuran', '$warna', '$jumlah', '$ongkir', '$harga', '$metode', DATE_FORMAT(CURDATE(),'%d-%m-%Y'), now(), $id_userjual, $id_pesanjual)";
              $query_insert2 = mysqli_query($con, $sql_insert2);

              $sql_hapus = "DELETE FROM bukti where id_bukti = $id_bukti";
              $query_hapus = mysqli_query($con, $sql_hapus);
                
            }elseif($_GET['act'] == "hapus"){
              $sql_hapus = "DELETE FROM bukti where id_bukti = $id_bukti";
              $query_hapus = mysqli_query($con, $sql_hapus);
            }

            include "classes/class.phpmailer.php";
            $mail = new PHPMailer; 
            $mail->IsSMTP();
            $mail->SMTPSecure = 'ssl'; 
            $mail->Host = "smtp.gmail.com"; //host email
            $mail->SMTPDebug = 1;
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->Username = "your email"; //user email
            $mail->Password = "your password aplication"; //password email 
            $mail->SetFrom("your email","IRFAN JAYA Store"); //set email pengirim
            $mail->Subject = $subjek; //subyek email
            $mail->AddAddress($tujuan);  // email tujuan
            $mail->MsgHTML($pesan); //pesan


            if($mail->Send()){
              echo "<script>alert('Kirim Pesan Sukses')</script>";
              echo "<meta http-equiv='refresh' content='0; url=emailpage.php'>";
            }else{
              echo "<script>alert('GAGAL')</script>";
              echo "<meta http-equiv='refresh' content='0; url=emailpage.php'>";
            }
        }else{
          die("Pemberitahuan Transaksi Gagal Terkirim");
        }

    ?>