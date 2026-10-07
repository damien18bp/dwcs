<?php

class Animal{
    private int $id;
    protected ?string $nombre;

    function __construct(int $id, ?string $nombre)
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function say():string{
        $nombre = $this->nombre ?? "";
        return "$nombre: (soy un animal) awwwwww";
    }
}

class Perro extends Animal{

    private bool $pulgas;

    public function __construct(int $id, ?string $nombre, bool $pulgas)
    {
        $this->pulgas = $pulgas;
        parent::__construct($id,$nombre);
    }

    public function say():string{
        return "(soy un perro): guau, guau";
    }
}

class Pajaro extends Animal{

    private bool $vuela;

    public function __construct(int $id, ?string $nombre, bool $vuela)
    {
        $this->vuela = $vuela;
        parent::__construct($id,$nombre);
    }

    public function say():string{
        $nombre = parent::$nombre ?? "";
        return "$nombre: (soy un pajaro): pio, pio";
    }
}