<?php
<<<<<<< HEAD

include "clases.php";
include "Persona.php";
echo "01<br>";
=======
include "clases.php";
include "Persona.php";
include "Animal.php";
echo "O1<br>";
>>>>>>> origin/main

$nombre = "MiOtraClase";
$o1 = new MiClase();
var_dump($o1);
<<<<<<< HEAD
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

$toxo = new Perro(1, "Toxo");
var_dump($toxo);
=======
$o2 = new $nombre("Profe");
$o2->addToNombre("Sor");
// echo $o1->saludo();
echo "O2:<br>";
var_dump($o2);
echo "<br><h1>Persona</h1>";

$p1 = new Persona("Pedro", "Pérez");

$p1->setNombre("John")
    ->setApellido1("Lucas")
    ->setApellido2("Barreiro");
// $p1->setApellido1("Lucas");
// $p1->setApellido2("Barreiro");


var_dump($p1);

echo "<br><h1>Perro que hereda de Animal</h1>";

$toxo = new Perro(1, "Toxo");
var_dump($toxo);
echo $toxo->say();
>>>>>>> origin/main
