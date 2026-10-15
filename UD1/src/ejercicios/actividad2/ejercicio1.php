<?php

/**
 * Ejercicio 1: Clase Básica con Getters y Setters
    Crea una clase Persona con las siguientes propiedades: nombre y edad.

    Implementa el constructor para inicializar ambas propiedades.

    Crea los métodos getters y setters para acceder y modificar dichas propiedades.


 */

 class Persona{
    private string $nombre;
    private int $edad;

    public function __construct(string $nombre, int $edad)
    {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }

    public function getNombre():string{
        return $this->nombre;
    }

    public function getEdad():int{
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