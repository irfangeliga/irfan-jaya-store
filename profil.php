<?php
require_once('config.php');
session_start();
$id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id = '$id'";
$query = mysqli_query($con, $sql);
$db_toko = mysqli_fetch_assoc($query);

if(!isset($_SESSION['customerijs'])){
  if(!isset($_SESSION['web'])){
    if(!isset($_SESSION['id'])){
      header('location: login.php');
    }
    header('location: login.php');
  }
  header('location: login.php');
}

if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $gender = $_POST['gender'];
    $alamat = $_POST['alamat'];
    $nomor = $_POST['nomor'];
    $id_user = $_POST['id'];

    $passend  = password_hash($pass, PASSWORD_DEFAULT);
    
  
    $direktori = "img/user/";
    $file_name = $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'],$direktori.$file_name);

        if(empty($file_name )){
            $sql = "UPDATE users SET name ='$nama', username ='$username' , email = '$email', password = '$pass', gender = '$gender', alamat = '$alamat', nomor = '$nomor'  WHERE id = $id_user";
            $query = mysqli_query($con, $sql);
        }else{
            $sql = "UPDATE users SET name ='$nama', username ='$username' , email = '$email' , photo = '$file_name', password = '$passend', gender = '$gender', alamat = '$alamat', nomor = '$nomor'  WHERE id = $id_user";
            $query = mysqli_query($con, $sql);
        }
        
    // apakah query update berhasil?
    if( $query ) {

        echo "<script> 
        document.location.href = 'index.php';
            alert('Data berhasil disimpan!');
           
           
            </script>";
    } else {
        echo "<script> 
        document.location.href = 'profil.php';
            alert('Data gagal disimpan!');
            </script>";
    }

}
    
?>

<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">  
    <title>Profil Saya</title>
  </head>
  <body style="background-color:#e6dede">
    <!-- navbar --> 
    <?php require_once('nav-cart.php'); ?>
    <!-- end navbar -->

      <!-- kelas -->
      <div class="w-50 ms-auto me-auto h-auto bg-light" style="w" 
        <br><br><br><br>
        <div class="text-center fw-bold" style="opacity:50%;color:black;font-size:450%">
            <p >PROFIL SAYA</p>
        </div>
        <div class="profil">
            <div class="text-center">
                <img src="img/user/<?php echo $db_toko['photo'] ?>" style="border:2px solid #000;width:15rem;height:17rem" class="rounded img-fluid " alt="foto-profil">
            </div>
            <div class=" fs-5   mt-5">
                <form action="" method="post" enctype="multipart/form-data">
                    <?php if(isset($_POST['edit'])){ ?>

                    <div class="row ">
                      <div class="col-4 ps-5 ms-5">
                        <label class="mb-3" for="nama">Nama Lengkap</label><br>
                        <label class="mb-4" for="username">Username</label><br>
                        <label class="mb-2">Jenis Kelamin</label><br>
                        <label class="mb-5" for="alamat">Alamat Lengkap</label><br>
                        <label class="mb-3 mt-5" for="nomor">Nomor Telpon</label><br>
                        <label class="mb-3" for="email">Email</label><br>
                        <label class="mb-2" for="password">Password</label><br>
                        <label for="foto">Ubah foto profil</label>
                      </div>
                     
                      <div class="col-7 pe-5">
                        <input type="text" id="nama" name="nama" class="form-control mb-2" value="<?php echo $db_toko['name'] ?>" >
                        <input type="text" id="username" name="username" class="form-control mb-3" value="<?php echo $db_toko['username'] ?>" >
                        <?php $jk = $db_toko['gender']; ?>
                        <label for="perempuan"><input type="radio" class="form-check-input" id="perempuan" name="gender" value="perempuan"  <?php echo ($jk == 'perempuan') ? "checked": "" ?>> Perempuan</label>&nbsp;&nbsp;&nbsp;
                        <label for="laki-laki"><input type="radio" class="form-check-input mb-3" name="gender" id="laki-laki" value="laki-laki" <?php echo ($jk == 'laki-laki') ? "checked": "" ?>> Laki-laki</label>
                        <textarea name="alamat" id="alamat" class="form-control mb-4" cols="43" rows="3" ><?php echo $db_toko['alamat'] ?></textarea>
                        <input type="tel" id="nomor" name="nomor" class="form-control mb-2" value="<?php echo $db_toko['nomor'] ?>" >
                        <input type="email" id="email" name="email" class="form-control mb-2" value="<?php echo $db_toko['email'] ?>" >
                        <input type="password" name="password" id="password" class="form-control mb-2" value="<?php echo $db_toko['password'] ?>">
                        <input type="file" name="foto" id="foto" class="form-control">
                        <span style="color:red;font-size:13px;font-weight:lighter;">*Pastikan foto telah berbentuk persegi atau memiliki panjang dan lebar yang sama</span>
                        <input type="hidden" name="id" value="<?php echo $db_toko['id']?>">
                        <div class="text-end mt-5">
                            <input type="submit" value="Simpan" class="btn btn-success pe-4 ps-4 fw-bold fs-5" name="simpan"><br><br>
                        </div>
                      </div>
                    </div>
                      <?php }else if (!isset($_POST['edit'])){ ?>
                    <div class="row">
                      <div class="col-4 ps-5 ms-5">
                        <label class="mb-3" for="nama">Nama Lengkap</label><br>
                        <label class="mb-4" for="username">Username</label><br>
                        <label class="mb-2">Jenis Kelamin</label><br>
                        <label class="mb-5" for="alamat">Alamat Lengkap</label><br>
                        <label class="mb-3 mt-5" for="nomor">Nomor Telpon</label><br>
                        <label class="mb-3" for="email">Email</label><br>
                        <label class="mb-3" for="password">Password</label>
                      </div>
                      <div class="col-7 pe-5">
                        <input type="text" id="nama" name="nama" class="form-control mb-2" value="<?php echo $db_toko['name'] ?>" disabled>
                        <input type="text" id="username" name="username" class="form-control mb-3" value="<?php echo $db_toko['username'] ?>" disabled>
                        <?php $jk = $db_toko['gender']; ?>
                        <label for="perempuan"><input type="radio" class="form-check-input" id="perempuan" name="gender" value="perempuan"  <?php echo ($jk == 'perempuan') ? "checked": "" ?> disabled> Perempuan</label>&nbsp;&nbsp;&nbsp;
                        <label for="laki-laki"><input type="radio" class="form-check-input mb-3" name="gender" id="laki-laki" value="laki-laki" <?php echo ($jk == 'laki-laki') ? "checked": "" ?> disabled> Laki-laki</label>
                        <textarea name="alamat" id="alamat" class="form-control mb-4" cols="43" rows="3" disabled><?php echo $db_toko['alamat'] ?></textarea>
                        <input type="tel" id="nomor" name="nomor" class="form-control mb-2" value="<?php echo $db_toko['nomor'] ?>" disabled>
                        <input type="email" id="email" name="email" class="form-control mb-2" value="<?php echo $db_toko['email'] ?>" disabled>
                        <input type="password" name="password" id="password" class="form-control" value="<?php echo $db_toko['password'] ?>" disabled>
                        <div class="text-end mt-5">
                            <input type="submit" value="Edit Profile" class="btn btn-primary pe-4 ps-4 fw-bold fs-5" name="edit"><br><br>
                        </div>
                      </div>
                    </div>  
                    <?php } ?>
                </form>
            </div>
            </div>
        </div>
        <!-- end kelas -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>