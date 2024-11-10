<?php

class Alergenos
{
    public $id;
    public $nombre;
    public $foto;

    public function __construct($nombre, $foto, $id = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->foto = $foto;
    }
}
