
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
    <title>Data Member | Halaman Admin</title>
</head>
<body>
    <div class="row ms-0 me-0">
        <div class="col-2">
           <?php 
           require_once('../config.php');
           session_start();
            require_once('navbar.php');
            
             
            $no = 1;
            $sql_data = "SELECT * FROM users";
            $query_data = mysqli_query($con, $sql_data);
            $row = mysqli_num_rows($query_data);
            
           ?>
        </div>
        <div class="col-10 mt-5 ">
            <div class="admin-body bg" style="height:55rem;">
                <?php 
                        if($row == 0){
                ?>
                <div  class="alert alert-primary fs-3 text-center ms-auto me-auto" role="alert" style="top:40%;width:50%">
                    <p><i class="bi bi-emoji-neutral"></i>&nbsp;&nbsp;Tidak Ada Customer Terdaftar</p>
                </div>
                <?php }else{ ?>
                <div class="tabel ms-auto me-auto"><br>
                    <h3>Customer Terdaftar</h3>
                    <table class="table table-striped" style="height:45rem;">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Customer</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Foto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($user = mysqli_fetch_array($query_data)){ ?>
                                <tr >
                                <th scope="row"><?php echo $no ?></th>
                                <td><?php echo $user['name'] ?></td>
                                <td><?php echo $user['username'] ?></td>
                                <td>@<?php echo $user['email'] ?></td>
                                <td><?php echo $user["alamat"]?></td>
                                <td><?php echo $user['photo'] ?></td>
                            </tr>
                            <?php
                                $no++; }
                            ?>
                        </tbody>
                    </table>
                <div>
                <!-- <div class="row text-primary">
                    <div class="col-3  ">
                        <div class="p-2">Total Pengunjung:</div>
                    </div>
                    <div class="col-3 ">
                        <div class="p-2">Total Pembeli:</div>
                    </div>
                    <div class="col-3 ">
                        <div class="p-2">Total Pembeli:</div>
                    </div>
                    <div class="col-3 ">
                        <div class="p-2">Total Pembeli:</div>
                    </div>
                </div> -->
                <div class="row mt-4 p-0">
                    <div class="col-3 ms-auto text-end">
                        <a href="cetak.php?menu=data_user" class="btn btn-success">Downoad Data Customer</a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>