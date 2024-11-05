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

    public function __construct($id = null, $fecha, $estado, $precio, $direcction, $user, $lineas)
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->estado = $estado;
        $this->precio = $precio;
        $this->direcction = $direcction;
        $this->user = $user;
        $this->lineas = $lineas;
    }
}
