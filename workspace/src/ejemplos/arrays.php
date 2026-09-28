<?php

/**
 * Un array en PHP es un mapa ordenado con el formato 
 * [clave => valor]
 */

 //Declarar array con contenido
 $var = array(
    "uno" => "Primer elemento",
    "dos" => 2.02,
<<<<<<< HEAD
    "Tres" => FALSE,
=======
    "Tres" => FALSE;
>>>>>>> 371454b (creacion array y index)
    "2" => "ultima inserccion"
 );

 var_dump($var);

 //Aceder a un elemento de un array
 echo "<br>", $var[2];

 //Agregar elementos a un array
    //Por el final
        array_push($var,"Super ultima insercción con arrat_push");
        array_push($var,"otro push");
        $var[] = "push con []";
        var_dump($var);
    //En una posición
        $var["nuevo"] = true;
        $var[90] = "ES un 90";
        $var[] = "sigue indexando";
        var_dump($var);

//Eliminar un elemento de un array
unset($va["nuevo"]);

echo "Segundo vardump <br>";

var_dump($var);

//Recorrer

$var3 = ["Pera", "Manzana", "Platano"];
for($i=0; $i<count($var); $i++){
    echo "La posicion $i del array tiene: ", $var[$i], "<br>";
}