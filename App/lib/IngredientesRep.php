<?php

class IngredientesRep implements ICRUD
{

    /**
     * Saca por id
     * @var $id
     */
    static public function getbyId($id)
    {
        $con = Connection::getConection();
        $rest = $con->query('select id, nombre from ingredientes where id =' . $id . ';');
        while ($row = $rest->fetch()) {

            $alergenos = AlergenosRep::getAllbyingrediente($id);
            $ingrediente = new Ingredientes($row['id'], $row['nombre'], $alergenos, $row['precio']);
        }

        return $ingrediente;
    }

    /**
     * getAll
     */
    static public function getAll()
    {
        $con = Connection::getConection();
        $array = [];
        $rest = $con->query('select id, nombre from ingredientes;');
        while ($row = $rest->fetch()) {
            $alergenos = AlergenosRep::getAllbyingrediente($row['id']);
            $ingrediente = new Ingredientes($row['id'], $row['nombre'], $alergenos, $row['precio']);
            array_push($array, $ingrediente);
        }

        return $array;
    }

    /**
     * create
     *
     * @param  mixed $ingrediente
     * @return void
     */
    static public function create($ingrediente)
    {
        $con = Connection::getConection();

        // Insertar ingrediente
        $sql = 'INSERT INTO ingredientes(nombre, precio) VALUES (?, ?)';
        $stmt = $con->prepare($sql);
        $stmt->execute([$ingrediente->nombre, $ingrediente->precio]);

        // Obtener el id del ingrediente recién insertado usando parámetros preparados
        $sql2 = 'SELECT id FROM ingredientes WHERE nombre = ?';
        $stmt2 = $con->prepare($sql2);
        $stmt2->execute([$ingrediente->nombre]);
        $row = $stmt2->fetch();
        $id ='';
        // Si se encuentra el ingrediente, obtenemos el id
        if ($row) {
            $id = $row['id'];
        }
        var_dump($id);
        // Insertar las relaciones entre ingredientes y alergenos
        foreach ($ingrediente->alergenos as $i) {
            var_dump($i);
            var_dump($i->id);
            $sql3 = 'INSERT INTO ingredientes_has_alergenos(id_ingrediente, id_alergenos) VALUES (?, ?)';
            $stmt3 = $con->prepare($sql3);
            $stmt3->execute([$id, $i->id]);
        }
    }


    /**
     * delete
     *
     * @param  mixed $ingrediente
     * @return void
     */
    static public function delete($ingrediente)
    {
        $con = Connection::getConection();
        $sql = 'delete from ingrediente where id=?';
        $stmt = $con->prepare($sql);
        $stmt->execute([$ingrediente->id]);
    }


    /**
     * update
     *
     * @param  mixed $ingrediente
     * @return void
     */
    static public function update($ingrediente)
    {
        $con = Connection::getConection();
        $sql = 'update ingrediente set nombre=?, precio=? where id=' . $ingrediente->id . ';';
        $stmt = $con->prepare($sql);
        $stmt->execute($ingrediente->nombre, $ingrediente->precio);
    }


    /**
     * getbykebab
     */
    static public function getAllbyKebab($id)
    {
        $con = Connection::getConection();
        $array = [];
        $rest = $con->query('select id_ingrediente from kebab_has_ingredientes where id_kebab=' . $id . ';');
        while ($row = $rest->fetch()) {

            $ingrediente = IngredientesRep::getbyId($row['id_ingrediente']);

            array_push($array, $ingrediente);
        }

        return $array;
    }
}
