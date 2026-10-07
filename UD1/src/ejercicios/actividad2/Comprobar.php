<?php

include 'AmplicacionPersona.php';

$direccion = new Direccion("Calle Alfredo Saralegui", "Pontevedra", 36620);

$persona = new AmplicacionPersona("Damien", 15, $direccion);

echo $persona->getNombre(), " ";
echo $persona->getEdad(), " ";
echo $persona->mostrarDireccionCompleta();
echo "<br>";

if ($persona->esMayorDeEdad()){
    echo "La persona es mayor de edad";
}else{
    echo "La persona es menor de edad";
}