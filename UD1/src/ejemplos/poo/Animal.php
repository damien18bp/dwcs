<?php

class Animal{
    private int $id;
    protected ?string $nombre;

<<<<<<< HEAD
    function __construct(int $id, ?string $nombre)
=======
    public function __construct(int $id, ?string $nombre)
>>>>>>> origin/main
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function say():string{
        $nombre = $this->nombre ?? "";
        return "$nombre: (soy un animal) awwwwww";
    }
<<<<<<< HEAD
=======

>>>>>>> origin/main
}

class Perro extends Animal{

    private bool $pulgas;

<<<<<<< HEAD
    public function __construct(int $id, ?string $nombre, bool $pulgas)
    {
        $this->pulgas = $pulgas;
        parent::__construct($id,$nombre);
    }

    public function say():string{
        return "(soy un perro): guau, guau";
=======

    public function __construct(int $id, ?string $nombre, bool $pulgas = false)
    {
        $this->pulgas = $pulgas;
        parent::__construct($id, $nombre);
    }

    public function say():string{
        $nombre = $this->nombre ?? "";

        return "$nombre: (soy un perro): guau, guau";
>>>>>>> origin/main
    }
}

class Pajaro extends Animal{

    private bool $vuela;

<<<<<<< HEAD
    public function __construct(int $id, ?string $nombre, bool $vuela)
    {
        $this->vuela = $vuela;
        parent::__construct($id,$nombre);
=======
    public function __construct(int $id, ?string $nombre, bool $vuela = false)
    {
        $this->vuela = $vuela;
        parent::__construct($id, $nombre);
>>>>>>> origin/main
    }

    public function say():string{
        $nombre = parent::$nombre ?? "";
<<<<<<< HEAD
        return "$nombre: (soy un pajaro): pio, pio";
=======
        return "$nombre: (soy un pájaro): pio, pio";
>>>>>>> origin/main
    }
}