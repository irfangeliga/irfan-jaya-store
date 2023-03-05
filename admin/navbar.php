<?php 
$id = $_SESSION['idadminijs'];
$sql = "SELECT * FROM users WHERE id = '$id'";
$query = mysqli_query($con, $sql);
$db_toko = mysqli_fetch_assoc($query);

if(!isset($_SESSION['adminijs'])){
    header('location: ../login.php');
}
?>
<nav class="admin">
    <ul  class="menu">
        <li >
            <button type="button" onclick="run()" class="nav-logo d-flex text-center text-decoration-none">
                <img  src="img/logo.ico"  alt="logo toko" class="mt-2">
                <span class="navbar-brand fs-1" >Irfan Jaya</span>
            </button>
        </li>
        <li>
            <div class="nav-head mt-3 text-center text-warning">
                <img src="img/user/<?php echo $db_toko['photo'] ?>" style="width:200px;height:200px;" class="rounded-circle border img-fluid" alt="<?php echo $db_toko['photo'] ?>"><br>
                <div class=" text-warning fs-3 text-capitalize" ><?php echo $db_toko['name'] ?></div>
            </div>
        </li>
        <li class="mt-2">
            <a href="index.php" class="link-nav text-decoration-none">
                <i class="bi bi-house icon-admin"></i>
                <span class="nav-list">Home</span>
            </a>
        </li>
        <li>
            <a href="data-user.php" class="link-nav text-decoration-none">
                <i class="bi bi-people-fill icon-admin"></i>
                <span class="nav-list">Data Member</span>
            </a>
        </li>
        <li>
            <a href="list-produk.php" class="link-nav text-decoration-none">
                <i class="bi bi-box2 icon-admin"></i>
                <span class="nav-list">List Produk</span>
            </a>
        </li>
        <li>
            <a href="form-input.php" class="link-nav text-decoration-none">
                <i class="bi bi-bag-plus icon-admin"></i>
                <span class="nav-list">Tambahkan Produk</span>
            </a>
        </li>
        <li>
            <a href="list-pesanan.php" class="link-nav text-decoration-none">
                <i class="bi bi-receipt icon-admin"></i>
                <span class="nav-list">Pesanan Customer</span>
            </a>
        </li>
        <li>
            <a href="konfirmasi.php" class="link-nav text-decoration-none">
                <i class="bi bi-bag-check icon-admin"></i>
                <span class="nav-list">Konfirmasi Pembayaran</span>
            </a>
        </li>
        <li>
            <a href="register.php" class="link-nav t-0 text-decoration-none">
                <i class="bi bi-person-lines-fill icon-admin"></i>
                <span class="nav-list">Registrasi Admin</span>
            </a>
        </li>
        <li>
            <a href="../logout.php" class="link-nav logout text-decoration-none">
                <i class="bi bi-box-arrow-left icon-admin"></i>
                <span class="nav-list">Keluar</span>
            </a>
        </li>
    </ul>
</nav>

<script defer type="text/javascript">
    const activePage = window.location.pathname;
    console.log(activePage);
    const navLinks = document.querySelectorAll('nav a').forEach(link => {
        if(link.href.includes(`${activePage}`)){
            link.classList.add('active');
        }
    })

    function run(){
        location.replace("index.php");
    }
</script>