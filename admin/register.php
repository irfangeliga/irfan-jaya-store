<?php
require_once('../config.php');
 session_start();
 if(!isset($_SESSION['adminijs'])){
    header('location: ../login.php');
}
$error = '';
$validate = '';

if(isset($_POST['register'])){

    // filter data yang diinputkan
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];
    $password = mysqli_real_escape_string($con, $password);
    $repass   = $_POST['repass'];
    $repass = mysqli_real_escape_string($con, $repass);
    $status = "Admin";
    $nomor = $_POST['nomor'];
    $alamat = $_POST['alamat'];
    $gender = $_POST['gender'];
    
    $direktori = "./img/user/";
    $file_name = $_FILES['foto']['name'];
    move_uploaded_file($_FILES['foto']['tmp_name'],$direktori.$file_name);

    if(!empty(trim($name)) && !empty(trim($username)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($repass))){
        //mengecek apakah password yang diinputkan sama dengan re-password yang diinputkan kembali
        if($password == $repass){
            //memanggil method cek_nama untuk mengecek apakah user sudah terdaftar atau belum
            if( cek_nama($name,$con) == 0 ){
                //hashing password sebelum disimpan didatabase
                $pass  = password_hash($password, PASSWORD_DEFAULT);
                //insert data ke database
                $query = "INSERT INTO users (username,name,email, password, photo, status, alamat, nomor, gender ) VALUES ('$username','$name','$email','$pass', '$file_name', '$status', '$alamat', '$nomor', '$gender')";
                $result   = mysqli_query($con, $query);

                if ($result) {
                    header('Location: ../login.php');
                        
                } else {
                    $error =  'Register User Gagal !!';
                }
            }else{
                    $error =  'Username sudah terdaftar !!';
            }
        }else{
            $validate = 'Password tidak sama !!';
        }
         
    }else {
        $error =  'Data tidak boleh kosong !!';
    }
}
function cek_nama($username,$con){
    $nama = mysqli_real_escape_string($con, $username);
    $query = "SELECT * FROM users WHERE username = '$nama'";
    if( $result = mysqli_query($con, $query) ) return mysqli_num_rows($result);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
    <title>Halaman Register | Halaman Admin</title>
</head>
<body>
    <div class="bg">
        <div class="box">
            <div class=" card card-register text-light mb-3 pe-4 ps-4 pt-2 pb-2" style="max-width: 40rem; ">
                <div class="card-header fs-3">ADMIN REGISTER</div>
                <hr size="3px"; style="color:orange; opacity:1;margin: 0 0">
                <div class="card-body">
                    <h5 class="card-title mb-3 text-warning">Silahkan Isikan Data Pribadimu di Bawah Ini !!</h5>
                    <?php if($error != ''){ ?>
                        <div class="alert alert-danger" role="alert"><?= $error; ?></div>
                    <?php } ?>
                    <form action="register.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group mt-1 mb-4">
                                    <label for="name" >Nama Lengkap</label>
                                    <input class="form-control mb-2" type="text" id="name" name="name" placeholder="Nama kamu" />
                                </div>
                                <div class="form-group mb-4">
                                    <label for="nomor" >No Whatsapp/Handphone</label>
                                    <input class="form-control mb-2" type="tel" id="nomor" name="nomor" placeholder="081256xxxx" />
                                </div>
                                <div class=" mb-4">
                                    <label >Jenis Kelamin</label><br>
                                    <label for="perempuan"><input type="radio" class="form-check-input" id="perempuan" name="gender" value="perempuan"> Perempuan</label>&nbsp;&nbsp;&nbsp;
                                    <label for="laki-laki"><input type="radio" class="form-check-input" name="gender" id="laki-laki" value="laki-laki"> Laki-laki</label>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="form-group mb-4 mt-1">
                                    <label for="username" >Username</label>
                                    <input class="form-control mb-2" type="text" id="username" name="username" placeholder="Username" />
                                </div>
                                
                                <div class="form-group mb-4">
                                    <label for="email" >Email</label>
                                    <input class="form-control mb-2" id="email" type="email" name="email" placeholder="Alamat Email" />
                                </div>
                                <div class="form-group mb-4">
                                    <label for="foto" >Upload Foto Profilmu</label>
                                    <input type="file" class="form-control" name="foto" id="foto" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="alamat" >Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="3" placeholder="jl manggis no. 1, kecamatan , kabupaten, provinsi" ></textarea>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="password" >Password</label><br>
                                    <input class="form-control mb-2" type="password" name="password" id="password" placeholder="Password" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-4">
                                    <label for="repass" >konfirmasi Password</label><br>
                                    <input class="form-control" type="password" name="repass" id="repass" placeholder="konfirmasi Password" />
                                    <?php if($validate != '') {?>
                                        <p class="text-danger"><?= $validate; ?></p>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-warning mb-2 form-control" name="register" value="DAFTAR" />
                    </form>
                    <a href="../login.php" class="akun-link">Sudah Punya Akun? Klik Disini</a>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

