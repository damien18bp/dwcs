<?php

class MiClase{

    private $var1 = "sdas";
    private $var2;

    // public function __construct(int $var1, string $var2)
    // {
    //     $this->var1 = $var1;
    //     $this->var2 = $var2;
    // }

    public function saludo(){
        return "Hola, soy el objeto $this->var1 con $this->var2";
    }

}

class MiOtraClase{
    //Propiedades
    private string $nombre;

    //Métodos
    function __construct(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function addToNombre(string $palabra){
        $this->nombre .= " ".$palabra;
    }

}