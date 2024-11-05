<?php

class LineaPedido {
    public $id;
    public $cantidad;
    public $producto;
    public $precio;
    public $pedidoid;

    public function __construct($id=null, $cantidad, $producto, $precio, $pedidoid) {
        self::$id = $id;
        self::$cantidad = $cantidad;
        self::$producto = $producto;
        self::$precio = $precio;
        self::$pedidoid = $pedidoid;
    }
}
