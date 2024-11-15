<?php

class Index
{
    public static function main()
    {
        require_once './routes/__autoload.php';
        require_once './views/partials/layout.php';
        //UserRep::addcarrito(51, "{nombre: 'La perra', precio: '60', ingredientes: Array(3), foto: 'http://localhost:8000/assets/img/laperra.jpg', cantidad: '1'}");
    }
}
Index::main();
