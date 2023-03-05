<?php

// $direktori = "../img/produk/";;
    // $file_name = $_FILES['foto_produk']['name'];
    // move_uploaded_file($_FILES['foto_produk']['tmp_name'],$direktori.$file_name);
    // $multiple = implode (",", $file_name);
    // move_uploaded_file($_FILES['foto_produk']['tmp_name'],$direktori.$file_name);

require_once("../config.php");
session_start();
$error = '';

$target[]="";
if(isset($_POST['tambah'])){

    $nama = $_POST['nama_produk'];
    $ukuran = implode(",", $_POST['ukuran']);
    $warna = implode(",", $_POST['warna']);
    $target = implode(",", $_POST['target']);
    $stok = $_POST['stok'];
    $harga = $_POST['harga'] * 1000;
    $deskripsi = $_POST['deskripsi_produk'];

    $direktori = "../img/produk/";
    $file_name = $_FILES['foto_produk']['name'];
    $tmp_name = $_FILES['foto_produk']['tmp_name'];
    $upload_data = array_combine($tmp_name,$file_name);
    $multiple = implode (",", $file_name);

    foreach($upload_data as $temp_folder => $image_name){
        move_uploaded_file($temp_folder, $direktori.$image_name);
    }
    if(!empty(trim($nama)) && !empty(trim($ukuran)) && !empty(trim($warna)) && !empty(trim($target)) && !empty(trim($stok)) && !empty(trim($harga)) && !empty(trim($deskripsi)) && !empty(trim($multiple))){

        $sql = "INSERT INTO produk (nama_produk, ukuran_produk, warna_produk, target_produk, stok_produk, harga_produk, foto_produk, deskripsi_produk, tanggal, waktu) VALUE 
                ('$nama', '$ukuran', '$warna','$target', '$stok', '$harga', '$multiple','$deskripsi', DATE_FORMAT(CURDATE(),'%d-%m-%Y'), now())";
        $query = mysqli_query($con, $sql);

        if( $query ) {
            echo " <script> 
                    alert('Produk Berhasil ditambahkan');
                    document.location.href = 'list-produk.php';
                    </script>";
        } else {
            echo " <script> 
                    alert('Produk Gagal ditambahkan');
                    document.location.href = 'form-input.php';
                    </script>";
        }
    }else {
        $error =  'Data tidak boleh kosong !!'; 
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
    <title>Fitur Kelola Produk | Halaman Admin</title>
</head>

<body style="background-color:#f6f6f2;">
    <div class="row ms-0 me-0">
        <div class="col-2">
            <?php require_once('navbar.php'); ?>
        </div>
        <div class="col-10"><br><br>
            <div class=" ms-auto me-auto mt-5 body-input" style="width: 60rem;">
                <div class="me-3 ms-3"><br>
                    <header class="text-center">
                        <h1 class="mb-4 fw-bold" >Fitur Tambah Produk</h1>
                        <h6 class="text-secondary">Silahkan Tambahkan Produk Anda di Bawah Ini !!</h6>
                    </header><br><br>
                    <?php if($error != ''){ ?>
                        <div class="alert alert-danger" role="alert"><?= $error; ?></div>
                    <?php } ?>
                    <div class="form-input">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <p>
                                <div class="row" style="margin-top: -1%">
                                    <div class="col-3 ms-3"></div>
                                    <div class="col-1 me-3">
                                        <label for="nama">Nama </label>
                                    </div>
                                    <div class="col-6 text-start" style="margin-left:5%;">
                                        <input type="text" name="nama_produk" id="nama" class="form-control" placeholder="nama produk" >
                                    </div>
                                </div>
                            </p>
                            <p>
                                <div class="row" >
                                    <div class="col-3 ms-3"></div>
                                    <div class="col-1 me-3">
                                        <label for="size">Ukuran </label>
                                    </div>
                                    <div class="col-6 text-start" style="margin-left:5%;">
                                        <input type="text" name="ukuran[]" id="size" class="form-control">
                                        <font size="2px" class="text-danger" >*Jika Ukuran lebih dari satu pisahkan dengan koma, seperti: s,m,xl</font>
                                        <!-- <div class="form-check form-check-inline">
                                            <label><input class="form-check-input" type="checkbox" name="ukuran[]" id="small" value="S"> S</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label><input class="form-check-input" type="checkbox" name="ukuran[]" id="medium" value="M"> M</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label><input class="form-check-input" type="checkbox" name="ukuran[]" id="large" value="L"> L</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label><input class="form-check-input" type="checkbox" name="ukuran[]" id="extra-large" value="XL"> XL</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label><input class="form-check-input" type="checkbox" name="ukuran[]" id="extra-large2" value="XXL"> XXL</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label><input class="form-check-input" type="checkbox" name="ukuran[]" id="extra-large3" value="XXXL"> XXXL</label>
                                        </div> -->
                                    </div>
                                </div>
                            </p>
                            <p>
                                <div class="row" >
                                    <div class="col-3 ms-3"></div>
                                    <div class="col-1 me-3">
                                        <label for="warna">Warna </label>
                                    </div>
                                    <div class="col-6 text-start" style="margin-left:5%;">
                                        <input type="text" name="warna[]" id="warna" class="form-control">
                                        <font size="2px" class="text-danger" >*Jika Warna lebih dari satu pisahkan dengan koma, seperti: biru,merah</font>
                                        <!-- <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" value="Hitam" id="hitam" name="warna[]">
                                            <label class="form-check-label" for="hitam">
                                                Hitam
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" value="Putih" id="putih" name="warna[]">
                                            <label class="form-check-label" for="putih">
                                                Putih
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" value="Merah" id="merah" name="warna[]">
                                            <label class="form-check-label" for="merah">
                                                Merah
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" value="Abu-abu" id="abu" name="warna[]">
                                            <label class="form-check-label" for="abu">
                                                Abu-abu
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" value="biru" id="biru" name="warna[]">
                                            <label class="form-check-label" for="anak">
                                                Biru
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" value="Orange" id="orange" name="warna[]">
                                            <label class="form-check-label" for="orange">
                                                Orange
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" value="Kuning" id="kuning" name="warna[]">
                                            <label class="form-check-label" for="kuning">
                                                Kuning
                                            </label>
                                        </div> -->
                                    </div>
                                </div>
                            </p>
                            <!-- <p>
                                <div class="row" style="margin-top: -1%">
                                    <div class="col-3 ms-3"></div>
                                    <div class="col-1 me-3">
                                        <label for="kategori">Kategori </label>
                                    </div>
                                    <div class="col-6 text-start" style="margin-left:5%;">
                                        <div>
                                            <select id="Select" class="form-select form-control" name="kategori">
                                                <option>Tas</option>
                                                <option>Pakaian</option>
                                                <option>Payung</option>
                                                <option>Hoodie</option>
                                                <option>Topi</option>
                                                <option>Celana</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </p> -->
                            <p>
                                <div class="row" style="margin-top: -1%">
                                    <div class="col-3 ms-3"></div>
                                    <div class="col-1 me-3">
                                        <label for="target">Target </label>
                                    </div>
                                    <div class="col-6 text-start" style="margin-left:5%;">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" value="Anak-anak" id="anak" name="target[]">
                                            <label class="form-check-label" for="anak">
                                                Anak-anak
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" value="Pria" id="pria" name="target[]">
                                            <label class="form-check-label" for="pria">
                                                Pria
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" value="Wanita" id="wanita" name="target[]">
                                            <label class="form-check-label" for="wanita">
                                                Wanita
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </p>
                            <p>
                                <div class="row" style="margin-top: -1%">
                                    <div class="col-3 ms-3"></div>
                                    <div class="col-1 me-3">
                                        <label for="stok">Stok </label>
                                    </div>
                                    <div class="col-6 text-start" style="margin-left:5%;">
                                        <input type="number" name="stok" min="0" value="0" step="any"  class="form-control"   >
                                    </div>
                                </div>
                            </p>
                            <p>
                                <div class="row" style="margin-top: -1%">
                                    <div class="col-3 ms-3"></div>
                                    <div class="col-1 me-3">
                                        <label for="harga">Harga </label>
                                    </div>
                                    <div class="col-6 text-start ms-5 fs-6" >
                                        <input type="text" name="harga" class="border rounded-1 w-50 " id="rupiah" >
                                    </div>
                                </div>
                            </p>
                            <p>
                                <div class="row mb-4" >
                                    <div class="col-3 ms-3"></div>
                                    <div class="col-2 ">
                                        <label for="foto_produk">Foto Produk </label>
                                    </div>
                                    <div class="col-6 text-start ps-0 pe-4">
                                        <input type="file" name="foto_produk[]" class="form-control" multiple >
                                    </div>
                                </div>
                            </p>
                            <p>
                                <div class="row" >
                                    <div class="col-3 ms-3"></div>
                                    <div class="col-2">
                                        <label for="deskripsi_produk">deskripsi produk</label>
                                    </div>
                                    <div class="col-6 text-start ps-0 pe-4">
                                        <textarea name="deskripsi_produk" id="deskripsi_produk" class="form-control"></textarea>
                                </div>
                            </p>
                            <p>
                                <div class="row" >
                                    <div class="col-3 "></div>
                                    <div class="col-2 ">
                                    </div>
                                    <div class="col-7 pe-5 ps-4">
                                        <input type="submit" class="form-control fw-bold btn-tambah tombol-simpan" value="Tambahkan" name="tambah" />
                                    </div>
                                </div>
                            </p>
                        </form>
                    </div>
                </div><br>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    var rupiah = document.getElementById('rupiah');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value);
		});
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
   </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>