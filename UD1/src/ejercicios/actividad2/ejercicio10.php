<?php

/**
 * Ejercicio 10: Interfaces y Múltiples Tipos de Objetos
Crea una interfaz Identificable con el método getIdentificador.

Implementa esta interfaz en las clases Estudiante y Profesor. El identificador en Estudiante será el número de estudiante y en Profesor será su número de empleado.

Crea una función que reciba un array de objetos de tipo Identificable y muestre los identificadores de todos ellos.
 */


 interface Identificable{
    public function getIdentificador():string;
 }


abstract class PersonaAbstracta{
    protected int $edad;
    protected string $nombre;

    public function __construct($nombre, $edad){
        $this->nombre = $nombre;
        $this->edad = $edad;
    }

    public function cumplirAnos(){
        $this->edad++;
    }

    public abstract function mostrarInformacion():string;
    public abstract function esMayorDeEdad():bool;
}


 class Profesor extends PersonaAbstracta
 {
 
     public string $especialidad;
 
     public function __construct(string $especialidad, string $nombre, int $edad)
     {
         $this->especialidad = $especialidad;
         parent::__construct($nombre, $edad);
     }
 
     public function mostrarInformacion():string{
         return "Soy el profesor ". $this->nombre;
     }

     public function esMayorDeEdad():bool{
        return $this->edad > 17;
     }
 }
 
class Estudiante extends PersonaAbstracta implements Identificable
{

    public string $grado;
    private array $calificaciones;

    public function __construct(string $grado, string $nombre, int $edad,  array $notas = [])
    {
        $this->grado = $grado;
        $this->calificaciones = $notas;
        parent::__construct($nombre, $edad);
    }

    public function mostrarInformacion():string{
        return "Soy el estudiante ". $this->nombre;
    }

    public function esMayorDeEdad():bool{
        return $this->edad >= 18;
     }

    /**
     * 
     */
    public static function calcularPromedio(array $notas): float
    {
        $media = 0.0;

        foreach ($notas as $nota) {
            $media += $nota;
        }
        $media = $media / count($notas);
        return $media;
    }

    public function getMedia(): float
    {
        return Estudiante::calcularPromedio($this->calificaciones);
    }
}



function mostrarIds(array $identificables){

    foreach($identificables as $obj){
        if($obj instanceof Identificable){
            echo $obj->getIdentificador()."<br>";
        }
    }
}