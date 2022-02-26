<!DOCTYPE html>
<html>
<body>
<?php
class Fruit {
    public $name;
    public $color;

    function __construct($name, $color){
        $this ->name = $name;
        $this ->color = $color;
    }

    function __destruct(){
        echo "buah {$this->name} memiliki warna {$this->color}.<br/>";
    }
}
 $apple = new Fruit("Kuning","Nangka");
 echo $apple->name." adalah buah asal indonesia <br/>";
 echo "UJIAN UTS PWL 2021<br/>";
 
?>
</body>
</html>