<?php

class MiClase{
    private $var1;
    private $var2;

    public function __construct(int $var1, string $var2)
    {
        $this->var1 = $var1;
        $this->var2 = $var2;
    }

    public function saludo(){
        return "Hola, soy el objeto $this->var1 con $this->var2";
    }
}