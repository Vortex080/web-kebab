<?php

class User
{
    public $id;
    public $nombre;
    public $pass;
    public $direcction;
    public $monedero;
    public $foto;
    public $alergenos;

    public function __construct($nombre, $pass, $monedero, $foto, $direcction = null, $alergenos = null, $id = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->pass = $pass;
        $this->direcction = $direcction;
        $this->monedero = $monedero;
        $this->foto = $foto;
        $this->alergenos = $alergenos;
    }
}
