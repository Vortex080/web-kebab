<?php

class Ingredientes
{
    public static $id;
    public static $nombre;
    public static $alergenos;

    public function __construct($id=null, $nombre, $alergenos)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->alergenos = $alergenos;
    }
}
