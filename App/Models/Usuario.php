<?php

class User
{
    public static $id;
    public static $nombre;
    public static $pass;
    public static $direcction;
    public static $monedero;
    public static $foto;

    public function __construct($id = null, $nombre, $pass, $direcction, $monedero, $foto)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->pass = $pass;
        $this->direcction = $direcction;
        $this->monedero = $monedero;
        $this->foto = $foto;
    }
}
