<?php

class User
{
    public $id;
    public $nombre;
    public $pass;
    public $direcction;
    public $monedero;
    public $foto;
    public $email;
    public $rol;
    public $alergenos;
    public $carrito;

    public function __construct($nombre, $pass, $monedero, $foto, $email, $rol = 'usuario', $direcction = null, $alergenos = null, $carrito = [], $id = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->pass = $pass;
        $this->direcction = $direcction;
        $this->monedero = $monedero;
        $this->foto = $foto;
        $this->alergenos = $alergenos;
        $this->email = $email;
        $this->rol = $rol;
        $this->carrito = $carrito;
    }
}
