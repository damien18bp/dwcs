<?php

class Persona{

    //Propiedades
    private string $nombre;
    private int $edad;

    //Constructor
    public function __construct(string $nombre, int $edad)
    {  
        $this->nombre = $nombre;
        $this->edad = $edad;
        
    }
    //Métodos

    public function getNombre(): string{
        return $this->nombre;
    }

    public function getEdad(): int{
        return $this->edad;
    }

    public function setNombre(string $nombre):Persona{
        $this->nombre = $nombre;
        return $this;
    }

    public function setEdad(int $edad):Persona{
        $this->edad = $edad;
        return $this;
    }
}