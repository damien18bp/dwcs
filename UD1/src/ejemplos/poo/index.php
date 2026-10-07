<?php

include "clases.php";
include "Persona.php";
echo "01<br>";

$nombre = "MiOtraClase";
$o1 = new MiClase();
var_dump($o1);
$o2 = new $nombre("profe");
$o2->addToNombre("SOr");

echo "02:<br>";
var_dump($o2);
echo "<br><h1>Persona</h1>";

$p1 = new Persona("Pedro","Perez");

$p1->setNombre("Abdul")
        ->setapellido1("Lucas")
        ->setApellido2("Barreiro");
// $p1->setApellido1("Lucas");
// $p1->setApellido2("BArreiro");

var_dump($p1);

echo "<br><h1>Perro que hereda de animal</h1>";

$toxo = new Perro();
var_dump($toxo);
