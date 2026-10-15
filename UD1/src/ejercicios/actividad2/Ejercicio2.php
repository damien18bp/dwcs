<?php

include 'Direccion.php';

class Persona{

    //Propiedades
    private string $nombre{
        get{
            error_log("Accedo a nombre y puedo hacer otras cosas");
            return $this->nombre;
        }

        set(string $valor){
            error_log("modifico nombre y pyedo hacer otra cosa");
            $this->nombre = $valor;
        }
    }
    private int $edad{
        get=>$this->edad;

        set(int $edad){
            if ($edad<0){
                throw new Exception("La edad no puede ser menro de 0");
            }
            $this->edad = $edad;
        }
    }

    //Constructor
    public function __construct( string $nombre, int $edad)
    {  
        $this->nombre = $nombre;
        $this->edad = $edad;
    }

    public function esMayorDeEdad(): bool{
        return $this->edad >= 18;
    }
}
