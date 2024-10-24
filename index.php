<?php

class Index {
    public static function main() {
        require_once './routes/__autoload.php';
        require_once './views/partials/layout.php';
    }
}



Index::main();

$comida = new Comida('kebab');
echo $comida->nombre;
