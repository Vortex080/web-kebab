<?php

class Ingredientes
{
    public static $id;
    public static $nombre;
    public static $alergenos;

    public function __construct($id, $nombre, $alergenos)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->alergenos = $alergenos;
    }
}
