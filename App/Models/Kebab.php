<?php

class Kebab
{
    public $id;
    public $nombre;
    public $foto;
    public $ingredientes;
    public $precio;

    public function __construct($nombre, $foto, $ingredientes, $precio, $id = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->foto = $foto;
        $this->ingredientes = $ingredientes;
        $this->precio = $precio;
    }
}
