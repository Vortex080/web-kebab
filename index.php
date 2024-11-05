<?php

class Index
{
    public static function main()
    {
        require_once './routes/__autoload.php';
        require_once './views/partials/layout.php';
    }
}
Index::main();

$a = new Ingredientes(null, 'kebab', [1, 2], 130);
$b = IngredientesRep::create($a);
echo $b;
