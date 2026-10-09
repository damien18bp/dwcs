<?php

class Estudiante extends AmplicacionPersona{

    public string $grado;

    public function __construct(string $nombre, int $edad, string $grado)
    {
        parent::__construct($nombre, $edad);
        $this->grado = $grado;
    }

    public function getGrado(): string{
        return $this->grado;
    }

    public function setGrado(string $grado): Estudiante{
        $this->grado=$grado;
        return $this;
    }

    public function mostrarInformacion(): string{
        return "Nombre: " . $this->getNombre() . "<br>"
               . "Edad: " . $this->getEdad() . "<br>"
               .  "Grado: " . $this->getGrado() . "<br>";
    }
}