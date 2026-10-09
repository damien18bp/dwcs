<?php

Class Pan{
    private string $nombre;
    private float $precio;
    private float $peso;
    private array $ingredientes;

    public function __construct(){
        $this->nombre = "Pan".rand(1,20);
        $this->precio = rand(1,5);
        $this->peso = rand(10,30);
        $this->ingredientes = [];
    }

    public function dividir(): Pan{
        $this->peso /= 2; //$this->peso = $this->peso/2;
        $this->precio *= 0.6;
        $otraMitad = new Pan();
        $otraMitad->nombre = $this->nombre . " mitad";
        $otraMitad->precio = $this->precio;
        $otraMitad->peso = $this->peso;
        return $otraMitad;
    }
}

class Horno{
    private string $modelo;
    private float $precio;
    private DateTime $fechaCompra;
    static int $cont = 0;
    const int VOLT = 4;

    public function tocaRevision(): bool{
        self::hornear(null,100,100);
        return true;
    }

    public static function hornear($masa=null, int $tiempo, int $temperatura): Pan{
        self::$cont++;
        self::VOLT;
        if ($temperatura>200 && $this->modelo === "X"){
            echo "Este horno no soporta esa temperatura";
        }
        return new Pan();
    }
}

//Asi lo uso
$miPan = Horno::hornear(null,100,124);
//Acceder a constante de clase
Horno::VOLT;