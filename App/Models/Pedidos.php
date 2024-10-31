<?php

class Pedido
{
    public static $id;
    public static $fecha;
    public static $estado;
    public static $precio;
    public static $direcction;
    public static $user;
    public static $lineas;

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
