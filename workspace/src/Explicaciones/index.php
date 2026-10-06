<?php
include "clases.php";
echo "objeto de MiClase<br>";

$o1 = new MiClase(3,"HOLA");
echo $o1->saludo();
echo "<br>";
var_dump($o1);