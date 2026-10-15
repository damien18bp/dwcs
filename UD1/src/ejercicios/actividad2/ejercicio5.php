<?php

/**
 * Ejercicio 5: Clase con Métodos Estáticos
Añade a la clase Estudiante un método estático llamado calcularPromedio que reciba un array de calificaciones y devuelva el promedio.

Utiliza este método para calcular el promedio de un estudiante.
 */

class Direccion
{
    private string $calle;
    private string $ciudad;
    private int $cp;

    public function __construct(string $calle, string $ciudad, int $cp)
    {
        $this->calle = $calle;
        $this->ciudad = $ciudad;
        $this->cp = $cp;
    }




    /**
     * Get the value of calle
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * Set the value of calle
     *
     * @return  self
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;

        return $this;
    }

    /**
     * Get the value of ciudad
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set the value of ciudad
     *
     * @return  self
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get the value of cp
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set the value of cp
     *
     * @return  self
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    public function __toString()
    {
        return $this->calle . ", "
            . strtoupper($this->ciudad)
            . " (" . $this->cp . ")";
    }
}


class Persona
{
    /**
     * Getes y setters con hooks.
     */
    public  string $nombre {
        get {
            error_log("Accedo a nombre y puedo hacer otras cosas.");
            return $this->nombre;
        }

        set(string $valor) {
            error_log("Modifico nombre y puedo hacer otras cosas.");
            $this->nombre = $valor;
        }
    }

    public int $edad {
        get => $this->edad;

        set(int $edad) {
            if ($edad < 0) {
                throw new Exception("La edad no puede ser menor a 0");
            }
            $this->edad = $edad;
        }
    }

    public Direccion $residencia;

    public function __construct(string $nombre, int $edad, Direccion $residencia)
    {
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->residencia = $residencia;
    }

    /**
     * Indica si la persona es mayor de edad. Una persona es mayor de edad si su edad es igual o superior a 18.
     */
    public function esMayorDeEdad(): bool
    {
        return $this->edad >= 18;
    }

    public function printDireccion(): string
    {
        return $this->residencia;
    }

    public function __toString(){
        return $this->nombre . " ".$this->edad . ", ". $this->residencia;
    }
}

class Estudiante extends Persona
{

    public string $grado;

    public function __construct(string $grado, string $nombre, int $edad, Direccion $residencia)
    {
        $this->grado = $grado;
        parent::__construct($nombre, $edad, $residencia);
    }

    public function mostrarInformacion():string{
        return parent::__toString()." Grado: ".$this->grado;
    }

    /**
     * 
     */
    public static function calcularPromedio(array $notas):float{
        $media = 0.0;
        
        foreach($notas as $nota){
            $media += $nota;
        }
        $media = $media / count($notas); 
        return $media;
    }
}

//Utilizo el método estático


$notas = [5,5.5,6];

echo "Media: ". Estudiante::calcularPromedio($notas);

