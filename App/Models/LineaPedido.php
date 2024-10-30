<?php

class LineaPedido {
    public static $id;
    public static $cantidad;
    public static $producto;
    public static $precio;
    public static $pedidoid;

    public function __construct($id=null, $cantidad, $producto, $precio, $pedidoid) {
        self::$id = $id;
        self::$cantidad = $cantidad;
        self::$producto = $producto;
        self::$precio = $precio;
        self::$pedidoid = $pedidoid;
    }
}
