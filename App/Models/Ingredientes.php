<?php

class Ingredientes
{
    public $id;
    public $nombre;
    public $alergenos;
    public $precio;

    public function __construct($nombre, $precio, $id = null, $alergenos = null)
    {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->id = $id;
        $this->alergenos = $alergenos;
    }
}
