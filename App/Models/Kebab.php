<?php

class Kebab
{
    public static $id;
    public static $nombre;
    public static $foto;
    public static $ingredientes;
    public static $precio;

    public function __construct($id = null, $nombre, $foto, $ingredientes, $precio)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->foto = $foto;
        $this->ingredientes = $ingredientes;
        $this->precio = $precio;
    }
}
