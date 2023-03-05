<?php 
require_once("config.php");
session_start();

$error = '';
$validate = '';
 
if(isset($_POST['login'])){
    $username = stripslashes($_POST['username']);
    //cara sederhana mengamankan dari sql injection
    $username = mysqli_real_escape_string($con, $username);
    // menghilangkan backshlases
    $password = stripslashes($_POST['password']);
    //cara sederhana mengamankan dari sql injection
    $password = mysqli_real_escape_string($con, $password);

    //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
    if(!empty(trim($username)) && !empty(trim($password))){

        //select data berdasarkan username dari database
        $query      = "SELECT * FROM users WHERE username = '$username'";
        $result     = mysqli_query($con, $query);
        $rows       = mysqli_num_rows($result);

        if ($rows === 1) {
            $hash   = mysqli_fetch_assoc($result);
            if(password_verify($password, $hash['password'])){
    
                if($hash['status'] == "Admin"){
                    $_SESSION['idadminijs'] = $hash['id'];
                    $_SESSION['adminijs'] = $hash['status'];
                    $_SESSION['web'] = "irfanjayaadmin";
    
                    header('location: admin/index.php');
                    exit;
                }else{
                    $_SESSION['id'] = $hash['id'];
                    $_SESSION['customerijs'] = $hash['status'];
                    $_SESSION['web'] = "irfanjaya";
    
                    header('location: index.php');
                    exit;
                }
            }else{
                $validate =  'Password tidak valid';
            }
                        
        //jika gagal maka akan menampilkan pesan error
        } else {
            $error =  'Username tidak terdaftar';
        }
    }else {
        $error =  'Data tidak boleh kosong !!';
    }
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
    <title>Halaman Log In</title>
</head>
<body >
    <div class="bg">
        <div class="box ">
            <div class="card card-register text-light mb-3 pe-5 ps-5 pt-2 pb-2 " style="max-width: 30rem;top:15rem;">
                <div class="card-header fs-3">LOGIN</div>
                <hr size="3px"; style="color:orange; opacity:1;margin: 0 0">
                <div class="card-body konten">
                    <h5 class="card-title text-warning">Silahkan masukkan Username dan kata sandi</h5>
                    <form action="" method="POST" >
                        <?php if($error != ''){ ?>
                            <div class="alert alert-danger" role="alert"><?= $error; ?></div>
                        <?php } ?>
                        <div class="mb-3 mt-3">
                            <label for="username" class="form-label " >Username</label>
                            <input class="form-control" type="text" name="username" id="username" placeholder="username atau email kamu" >
                        </div>
                        <div class="mb-1" >
                            <label for="password" class="form-label ">Kata Sandi</label>
                            <input class="form-control" type="password" name="password"  id="password">
                            <?php if($validate != '') {?>
                                <p class="text-danger"><?= $validate; ?></p>
                            <?php }?>
                        </div><br>
                        <input type="submit" class="btn btn-warning form-control mb-2 " name="login" value="Login" />
                    </form>
                    <a href="register.php" class="akun-link">Belum Punya Akun? Klik Disini</a>
                </div>
            </div>
        </div>
    </div>
    <!-- bootstrap javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>