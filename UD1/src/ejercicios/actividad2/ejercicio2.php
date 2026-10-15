<?php

/**
 * Ejercicio 2: Clase con Métodos de Validación
Amplía la clase Persona del ejercicio anterior.

Agrega una validación en el setter de edad, asegurando que solo se pueda asignar un valor positivo.

Añade un método esMayorDeEdad que devuelva true si la persona es mayor de 18 años.
 */

 class Persona{
    /**
     * Getes y setters con hooks.
     */
    public  string $nombre{
        get{
            error_log("Accedo a nombre y puedo hacer otras cosas.");
            return $this->nombre;
        }

        set(string $valor){
            error_log("Modifico nombre y puedo hacer otras cosas.");
            $this->nombre = $valor;
        }
    }

    public int $edad{
        get=> $this->edad;

        set(int $edad){
            if($edad <0){
                throw new Exception("La edad no puede ser menor a 0");
            }
            $this->edad = $edad;
        }
    }

    public function __construct(string $nombre, int $edad)
    {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }

    /**
     * Indica si la persona es mayor de edad. Una persona es mayor de edad si su edad es igual o superior a 18.
     */
    public function esMayorDeEdad():bool{
        return $this->edad >= 18;
    }
   
 }


 