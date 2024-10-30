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
        $sql = 'insert into ingredientes(id, nombre, precio) values (?, ?, ?)';
        $stmt = $con->prepare($sql);
        $stmt->execute([$ingrediente->id, $ingrediente->nombre, $ingrediente->precio]);
        foreach ($ingrediente->alergenos as $i) {
            $sql2 = 'insert into ingredientes_has_alergenos(id_ingrediente, id_alergenos) values (?, ?)';
            $stmt = $con->prepare($sql2);
            $stmt->execute([$ingrediente->id, $i->id]);
        }
    }


    /**
     * delete
     *
     * @param  mixed $kebab
     * @return void
     */
    static public function delete($kebab)
    {
        $con = Connection::getConection();
        $sql = 'delete from kebab where id=?';
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
