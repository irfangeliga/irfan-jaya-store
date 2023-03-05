<style>
  nav{
    font-family:'menu2';
  }
  .navbar-brand{
    font-family:'black';
  }
</style>
  <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-nav pt-3 pb-3 fixed-top" >
      <div class="container-fluid">
        <a class="navbar-brand" style="margin-right: auto;" href="index.php"><img src="../skripsi/img/logo.ico" alt="logo toko" style="width: 40px;height: 40px;">Irfan Jaya</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-5" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto menu-user fs-6 ">
          <li class="nav-item ms-3 me-2">
              <a class="nav-link " href="index.php">Home</a>
            </li>
            <li class="nav-item ms-3 me-2">
              <a class="nav-link " href="produk.php">Produk</a>
            </li>
            <li class="nav-item ms-3 me-2">
              <a class="nav-link " href="produk-pria.php">Pria</a>
            </li>
            <li class="nav-item ms-3 me-2">
              <a class="nav-link " href="produk-wanita.php">wanita</a>
            </li>
            <li class="nav-item ms-3 me-2">
              <a class="nav-link " aria-current="page" href="produk-anak.php">Anak-Anak</a>
            </li>
            <!-- <li class="nav-item dropdown ms-2 me-2">
              <a class="nav-link dropdown-toggle  " href="kategor.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Kategori Produk
              </a>
              <ul class="dropdown-menu text-uppercase" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item " href="#">T-shirt</a></li>
                <li><a class="dropdown-item " href="#">kaos lengan panjang</a></li>
                <li><a class="dropdown-item " href="#">baju berkera</a></li>
                <li><a class="dropdown-item " href="#">baju lever V</a></li>
              </ul>
            </li> -->
          </ul>
          <?php  if(isset($_SESSION['customerijs'])){
            $id = $_SESSION['id'];
            $sql = "SELECT * FROM users WHERE id = '$id'";
            $query = mysqli_query($con, $sql);
            $db_toko = mysqli_fetch_assoc($query);   
          ?>
          <a type="button" class="keranjang text-decoration-none" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <h2 style=" transform: scaleX(-1);margin-right:15px;margin-left:15px;" ><i class="bi bi-cart4 "></i></h2>
            <?php
               $sql_cart = "SELECT * FROM keranjang WHERE id_user='$id'";
               $query_cart = mysqli_query($con, $sql_cart);
               $jumlah_cart = mysqli_num_rows($query_cart);
              if($jumlah_cart > 0){
            ?>
            <div class="bg-danger text-light position-absolute ms-5 mt-1 " style="width:30px;height:30px;top:0;border-radius:50%;">
              <font size="3px" style="margin-left:5px;">
                <?php
                   echo $jumlah_cart;
                ?>
              </font>
            </div> <?php } ?>
          </a>
          <div class="btn-group dropstart">
            <button type="button"  style="padding:0;border:none;background:none;" data-bs-toggle="dropdown" aria-expanded="false">
            <ul class="d-flex mb-0 member">
              <li><img src="img/user/<?php echo $db_toko['photo'] ?>" class="foto-profil" alt="foto profil"></li>
              <li class="text-light fs-5 text-capitalize mt-2"><?php echo $db_toko['username']; ?></li>
              <li class="mb-0 fs-6 me-1 ms-2" style="margin-top:13px;" >
                  <i class="bi bi-caret-down-fill text-light"></i>
                </button>
                <ul class="dropdown-menu nav-profil" >
                  <li><a class="dropdown-item " href="PROFIL.PHP">Profil</a></li>
                  <li>
                    <a class="dropdown-item " href="chat-pesanan.php">Pesanan Saya
                      <?php 
                        $sql_pesan = "SELECT * FROM pesanan WHERE id_customer='$id'";
                        $query_pesan = mysqli_query($con, $sql_pesan);
                        $jumlah_pesan = mysqli_num_rows($query_pesan);
                        if($jumlah_pesan > 0){ ?>
                        <div class="bg-danger text-light position-absolute me-4 mt-5 " style="right:0;width:13px;height:13px;top:0;border-radius:50%;"></div>
                      <?php } ?> 
                    </a>
                  </li>
                  <li><a class="dropdown-item " href="riwayat-belanja.php">Riwayat Belanja</a></li>
                  <li><a class="dropdown-item" href="logout.php">keluar</a></li>
                </ul>
              </li>
            </ul>
           <?php }else{ ?>
            <a href="login.php"><button type="button" class="btn btn-outline-primary">LOGIN</button></a>
           <?php } ?>
          </div>
        </div>
      </div>
    </nav>
  <!-- end navbar -->

  <!-- STart Modal -->
    <div class="modal fade ms-auto me-auto"  id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content " >
          <div class="modal-header pe-5 ps-5">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Keranjang Anda</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body pe-2 ps-2" >
            <form action="" method="post" class="form-navcart" >
              <!-- <a id="btnEmpty" href="index.php?action=empty">Empty Cart</a> -->
              <?php
              // if(isset($_SESSION["cart_item"])){
              //     $total_quantity = 0;
              //     $total_price = 0;
              $no = 1;
              $total_price=0;
              if($jumlah_cart != 0){
              ?>	
              <div class="responsive-table" >
                <table class="table" style="height:390px;">
                  <thead>
                    <tr class="text-center">
                      <th>No</th>
                      <th>Foto</th>
                      <th>Nama</th>
                      <th>Ukuran</th> 
                      <th>Warna</th>
                      <th>Jumlah</th>
                      <th>Harga per produk</th>
                      <th>Hapus</th>
                    </tr>	
                  </thead>
                  <tbody>
                    <?php		
                    
                        while($cart = mysqli_fetch_array($query_cart)){

                          $cart_foto = $cart['foto'];
                          $cart_foto = explode("," , $cart_foto);
                          $count2 = count($cart_foto)-1;
                          $harga = $cart["harga"];
                          
                          // foreach ($_SESSION["cart_item"] as $item){
                          //     $item_price = $item["quantity"]*$item["price"];
                          // echo $item["name"]; 
                      ?>
                        <tr class="text-center text-capitalize">
                          <th scope="row"><?php echo $no ?></th>
                          <td><img  src="img/produk/<?php echo $cart_foto[0] ?>" width="100px" height="100px"></td>
                          <td>
                            <a href="detail-produk.php?id=<?php echo $cart["id_produk"] ?> ">
                              <?php echo $cart["nama"]; ?>
                            </a> <input type="hidden" id="id_keranjang" value="<?php echo $cart['id_keranjang'] ?>">
                          </td>
                          <td><?php echo $cart["ukuran"]; ?></td>
                          <td><?php echo $cart["warna"]; ?></td>
                          <td><?php echo $cart["jumlah"]; ?></td>
                          <td><?php echo rupiah($harga) ?></td>
                          <td class="text-center"><button type="button" class="remove-cart mt-3 btn btn-danger border border-0 fs-2 " ><i class=" bi bi-trash"></i></button></td>
                        </tr>
                        <?php $no++; } ?>
                  </tbody>
                </table>		
              </div>
                <p>Total Produk: <?php echo $jumlah_cart ?></p>
                <p>Total Harga : 
                  <?php 
                  foreach($query_cart as $total){
                    $total_price += ($total["harga"]*$total["jumlah"]); 
                  }
                  echo rupiah($total_price);
                  ?>
                </p>
                <?php }else{
                        echo "<h4 class='text-capitalize text-center'>Keranjang Anda Kosong</h4>";
                } ?>
              </div>
              <div class="btn-group " role="group" aria-label="Basic example">
                <button type="button" class="btn btn-secondary rounded-0 fs-5" data-bs-dismiss="modal">Close</button>
                <?php if($jumlah_cart != 0){ ?>
                  <a  href="detail-beli.php?kode=cart" class="btn btn-primary rounded-0 fs-5" >Beli Sekarang</a>
                <?php } ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  <!-- end Modal -->

  <script defer type="text/javascript">
    $(document).ready(function(){
      $('.remove-cart').click(function(){
        var data =$('.form-navcart').serialize();
        var id_keranjang =document.getElementById("id_keranjang").value;
        $.ajax({
          type:'POST',
          url:'cart-master.php?hapus='+id_keranjang,
          data:data,
          success:function(){
            alert("Item Berhasil dihapus dari Keranjang");
            location.reload();
          },
        });
      });
    });

    const activePage = window.location.pathname;
    console.log(activePage);
    const navLinks = document.querySelectorAll('nav a').forEach(link => {
        if(link.href.includes(`${activePage}`)){
            link.classList.add('active');
        }
    })

  </script>