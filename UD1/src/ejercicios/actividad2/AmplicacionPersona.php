<?php

include 'Direccion.php';

class AmplicacionPersona{

    //Propiedades
    private string $nombre;
    private int $edad;
    private Direccion $direccion;

    //Constructor
    public function __construct(string $nombre, int $edad, Direccion $direccion)
    {  
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->direccion = $direccion;
        
    }
    //Métodos

    public function getNombre(): string{
        return $this->nombre;
    }

    public function getEdad(): int{
        return $this->edad;
    }

    public function getDireccion(): Direccion{
        return $this->direccion;
    }

    public function setNombre(string $nombre):AmplicacionPersona{
        $this->nombre = $nombre;
        return $this;
    }

    public function setEdad(int $edad):AmplicacionPersona{
        if ($edad <= 0){
            throw new InvalidArgumentException(
                "La edad debe ser un valor positivo"
            );
        }
        $this->edad = $edad;
        return $this;
    }

    public function setDireccion(Direccion $direccion): AmplicacionPersona{
        $this->direccion = $direccion;
        return $this;
    }

    public function esMayorDeEdad(): bool{
        return $this->edad > 18;
    }

    public function mostrarDireccionCompleta(): string{
        return $this->direccion->direccionCompleta();
    }
}