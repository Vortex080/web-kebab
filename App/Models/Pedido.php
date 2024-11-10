<?php

class Pedido
{
    public $id;
    public $fecha;
    public $estado;
    public $precio;
    public $direcction;
    public $user;
    public $lineas;

    public function __construct($fecha, $estado, $precio, $direction, $user, $lineas=null, $id = null)
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->estado = $estado;
        $this->precio = $precio;
        $this->direcction = $direction;
        $this->user = $user;
        $this->lineas = $lineas;
    }
}
