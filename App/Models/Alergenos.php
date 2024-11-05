<?php

class Alergenos
{
    public $id;
    public $nombre;
    public $foto;

    public function __construct($id = null, $nombre, $foto)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->foto = $foto;
    }
}
