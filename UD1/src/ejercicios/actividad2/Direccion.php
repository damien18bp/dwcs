<?php

class Direccion{

    //Propiedades
    private string $calle;
    private string $ciudad;
    private int $codigoPostal;

    //Constructor

    public function __construct(string $calle, string $ciudad, int $codigoPostal)
    {
        $this->calle = $calle;
        $this->ciudad = $ciudad;
        $this->codigoPostal = $codigoPostal;
    }

    public function getCalle(): string{
        return $this->calle;
    }

    public function getCiudad(): string{
        return $this->ciudad;
    }

    public function getCodigoPostal(): int{
        return $this->codigoPostal;
    }

    public function setCalle(string $calle): Direccion{
        $this->calle = $calle;
        return $this;
    }

    public function setCiudad(string $ciudad): Direccion{
        $this->ciudad = $ciudad;
        return $this;
    }

    public function setCodigoPostal(int $codigoPostal): Direccion{
        $this->codigoPostal = $codigoPostal;
        return $this;
    }

    public function direccionCompleta():string{
        return $this->calle . ", "
                . $this->ciudad . ", "
                . $this->codigoPostal;
    }
}