<?php 
    require_once('../config.php');
    session_start();

    if(!isset($_GET['id_produk'])){
        header('Location: list-produk.php');
        exit();
    }
    $id_produk = $_GET['id_produk'];
    $sql = "SELECT * FROM produk where id_produk = $id_produk";
    $query= mysqli_query($con, $sql);
    $result = mysqli_fetch_assoc($query);

    if(isset($_POST['edit'])){
        $id= $_POST['id_produk'];
        $nama = $_POST['nama_produk'];
        $ukuran = implode(",", $_POST['ukuran']);
        $warna = implode(",", $_POST['warna']);
        $target = implode(",", $_POST['target']);
        $stok = $_POST['stok'];
        $harga = $_POST['harga']*1000 ;
        $deskripsi = $_POST['deskripsi_produk'];
        
    
        $direktori = "../img/produk/";
        $file_name = $_FILES['foto_produk']['name'];
        $tmp_name = $_FILES['foto_produk']['tmp_name'];
        $upload_data = array_combine($tmp_name,$file_name);
        $multiple = implode (",", $file_name);
    
        foreach($upload_data as $temp_folder => $image_name){
            move_uploaded_file($temp_folder, $direktori.$image_name);
        }
        
        if(!empty($file_name)){
            $sql = "UPDATE produk SET nama_produk='$nama', ukuran_produk='$ukuran', warna_produk='$warna', target_produk='$target', stok_produk='$stok', harga_produk='$harga', foto_produk='$multiple', deskripsi_produk='$deskripsi', tanggal= DATE_FORMAT(CURDATE(),'%d-%m-%Y'), waktu=now() WHERE id_produk= $id";
            $query = mysqli_query($con, $sql);
        }else{
            $sql = "UPDATE produk SET nama_produk='$nama', ukuran_produk='$ukuran', warna_produk='$warna', target_produk='$target', stok_produk='$stok', harga_produk='$harga', deskripsi_produk='$deskripsi', tanggal= DATE_FORMAT(CURDATE(),'%d-%m-%Y'), waktu=now() WHERE id_produk= $id";
            $query = mysqli_query($con, $sql);
        }
    
        // apakah query simpan berhasil?
        if( $query ) {
            echo " <script> 
                    alert('Produk Berhasil diedit');
                    document.location.href = 'list-produk.php';
                    </script>";
        } else {
            echo " <script> 
                    alert('Produk Gagal diedit');
                    document.location.href = 'list-produk.php';
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
    <title>Edit Produk | Halaman Admin</title>
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
                        <h1 class="mb-4 fw-bold" >Fitur Edit Produk</h1>
                        <h6 class="text-secondary">Silahkan Edit Produk Anda di Bawah Ini !!</h6>
                    </header><br><br>
                    <div class="form-input text-capitalize">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <p>
                                <div class="row" style="margin-top: -1%">
                                    <div class="col-3 ms-3"></div>
                                    <div class="col-1 me-3">
                                        <label for="nama">Nama </label>
                                    </div>
                                    <div class="col-6 text-start" style="margin-left:5%;">
                                        <input type="hidden" name="id_produk" value="<?php echo $result['id_produk'] ?>">
                                        <input type="text" name="nama_produk" id="nama" class="form-control" value="<?php echo $result['nama_produk'] ?>" >
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
                                        <input type="text" name="ukuran[]" id="size" value="<?php echo $result['ukuran_produk'] ?>" class="form-control">
                                        <font size="2px" class="text-danger" >*Jika Ukuran lebih dari satu pisahkan dengan koma, seperti: s,m,xl</font>
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
                                        <input type="text" name="warna[]" id="warna" value="<?php echo $result['warna_produk'] ?>" class="form-control">
                                        <font size="2px" class="text-danger" >*Jika Warna lebih dari satu pisahkan dengan koma, seperti: biru,merah</font>
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
                                            <?php 
                                                $target_usia = $result['target_produk'];
                                                $target_usia = explode("," , $target_usia); 
                                            ?>
                                            <label class="form-check-label" for="anak">
                                                <input class="form-check-input" type="checkbox" value="Anak-anak" id="Anak-anak" name="target[]" <?php if(in_array("Anak-anak", $target_usia)){ echo " checked=\"checked\""; } ?> >Anak-anak
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            
                                            <label class="form-check-label" for="pria">
                                                <input class="form-check-input" type="checkbox" <?php if(in_array("Pria", $target_usia)){ echo " checked=\"checked\""; } ?> value="Pria" id="Pria" name="target[]">Pria
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="wanita">
                                                <input class="form-check-input" type="checkbox" <?php if(in_array("Wanita", $target_usia)){ echo " checked=\"checked\""; } ?> value="Wanita" id="Wanita" name="target[]">Wanita
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
                                        <input type="number" name="stok" min="0" value="<?php echo $result['stok_produk'] ?>" step="any" class="form-control"   >
                                    </div>
                                </div>
                            </p>
                            <p>
                                <div class="row" style="margin-top: -1%">
                                    <div class="col-3 ms-3"></div>
                                    <div class="col-1 me-3">
                                        <label for="harga">Harga </label>
                                    </div>
                                    <?php 
                                        $harga_produk = $result['harga_produk'];
                                         function rupiah($angka){
                                            $hasil_rupiah =  number_format($angka,0,',','.');
                                            return $hasil_rupiah;
                                        }
                                    ?>
                                    <div class="col-6 text-start ms-5 fs-6" >
                                        <input type="text" name="harga" class="border rounded-1 w-50 " id="rupiah" value="<?php echo rupiah($harga_produk)  ?>">
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
                                        <input type="file" name="foto_produk[]"  id="foto_produk" value=""  multiple ><br>
                                        <font size="2px" class="text-danger" >*Jika tidak ada foto yang ditambahkan,silahkan lewati</font>
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
                                        <textarea name="deskripsi_produk" id="deskripsi_produk" class="form-control"><?php echo $result['deskripsi_produk'] ?></textarea>
                                </div>
                            </p>
                            <p>
                                <div class="row" >
                                    <div class="col-3 "></div>
                                    <div class="col-2 ">
                                    </div>
                                    <div class="col-7 pe-5 ps-4">
                                        <input type="submit" class="form-control fw-bold btn-tambah tombol-simpan" value="Edit Selesai" name="edit" />
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