<?php

class Ingredientes
{
    public static $id;
    public static $nombre;
    public static $alergenos;
    public static $precio;

    public function __construct($id=null, $nombre, $alergenos, $precio)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->alergenos = $alergenos;
        $this->precio = $precio;
    }
}
