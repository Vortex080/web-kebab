<?php

class Kebab
{
    public static $id;
    public static $nombre;
    public static $foto;
    public static $ingredientes;

    public function __construct($id=null, $nombre, $foto, $ingredientes)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->foto = $foto;
        $this->ingredientes = $ingredientes;
    }
}
