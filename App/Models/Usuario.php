<?php

class User
{
    public $id;
    public $nombre;
    public $pass;
    public $direcction;
    public $monedero;
    public $foto;

    public function __construct($id, $nombre, $pass, $direcction, $monedero, $foto)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->pass = $pass;
        $this->direcction = $direcction;
        $this->monedero = $monedero;
        $this->foto = $foto;
    }
}
