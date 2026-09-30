<?php
require "matematicas.php";

function printPotencia(int $base, int $exponentene):string{
    return "$base<sup>$exponentene</sup> = ". potencia($base, $exponentene);
}

$cosa = "SOY UNA COSA DECLARADA EN PRESENTACION.php";