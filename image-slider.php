
<style>
/* Slideshow container */
.slideshow-container {
  max-width: 40rem;
  position: relative;
  margin: auto;
  border:2px solid black;
  border-radius: 1px;
  background: rgb(14, 13, 13,0.2);
  overflow: hidden;
  
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  color:black;
  ;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
  color:white;
}

/* Number text (1/3 etc) */
.numbertext {
  color: white;
  font-size: 15px;
  padding: 12px 12px;
  margin: 3px;
  position: absolute;
  background-color: rgba(0,0,0,0.5);
  border-radius:50%;
}

.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: all 0.6s ease;
}

.active, .dot:hover {
  background-color: orange;
}
</style>


<div class="slideshow-container">
  <?php
    $id_produk = $_GET['id'];
    $sql = "SELECT * FROM produk WHERE id_produk='$id_produk'";
    $query = mysqli_query($con, $sql);
    $produk = mysqli_fetch_assoc($query);

    $toko = $produk['foto_produk'];
    $toko = explode("," , $toko);
    $count = count($toko);

    if($count > 1){ 
        $count2_produk = count($toko)-1;
        for($i=0;$i<=$count2_produk;++$i){
            $number = $i+1;
              $num_of = $count2_produk+1;
  ?>
  <div class="mySlides ">
      <div class="numbertext"><?php echo $number."/".$num_of; ?></div>
      <img src="./img/produk/<?php echo $toko[$i] ?>" style="width:40rem;height:37rem;">
  </div>
  <?Php }}else{ ?>
  <div class="mySlides ">
    <div class="numbertext">1/1</div>
    <img src="./img/produk/<?php echo $produk['foto_produk'] ?>" style="width:40rem;height:37rem;">
  </div>
  <?php } ?>
  <a class="prev text-decoration-none" onclick="plusSlides(-1)">❮</a>
  <a class="next text-decoration-none" onclick="plusSlides(1)">❯</a>

 
</div>
<div style="text-align:center; position:absolute; margin-left:430px;margin-top:-35px">
    <?php 
      $count2_produk = count($toko)-1;
      for($i=0;$i<=$count2_produk;++$i){
    ?>
      <span class="dot" onclick="currentSlide($i)"></span> 
    <?php } ?>
  </div><br>
<script type="text/javascript">
  let slideIndex = 1;
  showSlides(slideIndex);

  function plusSlides(n) {
    showSlides(slideIndex += n);
  }

  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}    
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
  }
</script>
