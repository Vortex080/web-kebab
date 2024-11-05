<?php

class Ingredientes
{
    public $id;
    public $nombre;
    public $alergenos;
    public $precio;

    public function __construct($id=null, $nombre, $alergenos, $precio)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->alergenos = $alergenos;
        $this->precio = $precio;
    }
}
