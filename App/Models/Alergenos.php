<?php

class Alergenos
{
    public static $id;
    public static $nombre;
    public static $foto;

    public function __construct($id=null = null, $nombre, $foto)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->foto = $foto;
    }
}
