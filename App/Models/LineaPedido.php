<?php

class LineaPedido
{
    public $id;
    public $cantidad;
    public $producto;
    public $precio;
    public $pedidoid;

    public function __construct($cantidad, $producto, $precio, $pedidoid, $id = null)
    {
        $this->id = $id;
        $this->cantidad = $cantidad;
        $this->producto = $producto;
        $this->precio = $precio;
        $this->pedidoid = $pedidoid;
    }
}
