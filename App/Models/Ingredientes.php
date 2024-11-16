<?php

class Ingredientes
{
    public $id;
    public $nombre;
    public $alergenos;
    public $precio;
    public $foto;

    public function __construct($nombre, $precio, $foto, $id = null, $alergenos = null)
    {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->id = $id;
        $this->alergenos = $alergenos;
        $this->foto = $foto;
    }
}
