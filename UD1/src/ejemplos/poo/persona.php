<?php

class Persona{

    //propiedades
    private string $nombre;
    private string $apellido1;
    private ?string $apellido2 = null;

    //Constructor
    public function __contruct($nombre, $ap1, $ap2=null)
    {
        $this->nombre = $nombre;
        $this->apellido1 = $ap1;
        $this->apellido2 = $ap2;
    }

    //Metodos

    public function getNombre(): string{
        return $this->nombre;
    }

    public function getApellido1(): string{
        return $this->apellido1;
    }

    public function getApellido2(): ?string{
        return $this->apellido2;
    }

    public function setNombre(string $nombre):Persona{
        $this->nombre = $nombre;
        return $this;
    }

    public function setApellido1(string $apellido1): Persona{
        $this->apellido1 = $apellido1;
        return $this;
    }

    public function setApellido2(string $apellido2): Persona{
        $this->apellido2 = $apellido2;
        return $this;
    }
}