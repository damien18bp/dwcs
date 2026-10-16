<?php

/**
 * Ejercicio 8: Relaciones entre Objetos: Curso y Estudiantes
    Crea una clase Curso que contenga un array de objetos Estudiante.

    Implementa un método para agregar estudiantes al curso.

    Añade un método mostrarEstudiantes que imprima la información de todos los estudiantes usando el método mostrarInformacion de cada estudiante.
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

    public function __toString()
    {
        return $this->nombre . " " . $this->edad . ", " . $this->residencia;
    }
}

class Estudiante extends Persona
{

    public string $grado;
    private array $calificaciones;

    public function __construct(string $grado, string $nombre, int $edad, Direccion $residencia, array $notas = [])
    {
        $this->grado = $grado;
        $this->calificaciones = $notas;
        parent::__construct($nombre, $edad, $residencia);
    }

    public function mostrarInformacion(): string
    {
        return parent::__toString() . " Grado: " . $this->grado;
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

class Curso
{
    private string $nombre;
    private array $estudiantes;

    public function __construct(string $nombre)
    {
        $this->nombre = $nombre;
        $this->estudiantes = [];
    }

    public function addEstudiante(Estudiante $e)
    {
        $this->estudiantes[] = $e;
    }

    /**
     * Devuelve un string en formato lista de html con todos los estudiantes del curso.
     */
    public function mostrarEstudiantes(): string
    {
        $toret = "<ul>";
        foreach ($this->estudiantes as $e) {
            $toret .= "<li>" . $e->mostrarInformacion() . "</li>";
        }
        $toret .= "</ul>";
        return $toret;
    }


    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
}

//Zona de pruebas

$miCurso = new Curso("CS_DAW");
$e1 = new Estudiante("Superior", "Pedro", 24, new Direccion("Falsa", "Narnia", 10100));
$e2 = new Estudiante("Medio", "Marta", 24, new Direccion("Bla", "Mordor", 20222));
$e3 = new Estudiante("Básico", "Lola", 24, new Direccion("Bla Bla", "La comarca", 66200));

//Esto es artificialmente complicado. No HACER. SI ENTENDER.
for ($i = 1; $i < 4; $i++) {
    $var = "e" . $i;
    $miCurso->addEstudiante($$var);
}

//Esto es lo que haría una persona normal.
// $miCurso->addEstudiante($e1);
// $miCurso->addEstudiante($e2);
// $miCurso->addEstudiante($e3);

echo "ESTUDIANTES DEL CURSO " . $miCurso->getNombre() . ":";
echo $miCurso->mostrarEstudiantes();
