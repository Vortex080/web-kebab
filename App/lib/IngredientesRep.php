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
     * Saca por nombre
     * @var $nombre
     */
    static public function getbyName($nombre)
    {
        $con = Connection::getConection();
        $rest = $con->query('select id, nombre from ingredientes where nombre =' . $nombre . ';');
        while ($row = $rest->fetch()) {

            $alergenos = AlergenosRep::getAllbyingrediente($row['id']);
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
        $rest = $con->query('select id, nombre, precio from ingredientes;');
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

        // Insertar ingrediente
        $con = Connection::getConection();
        $sql = 'insert into ingredientes(id, nombre, precio) values (?, ?, ?)';
        $stmt = $con->prepare($sql);
        $stmt->execute([$ingrediente->id, $ingrediente->nombre, $ingrediente->precio]);
    }


    public static function insertIngredienteHasAlergenos($i)
    {
        $con = Connection::getConection();
        $sql = 'insert into ingredientes_has_alergenos(id_ingrediente, id_alergenos) values (?, ?)';
        $stmt = $con->prepare($sql);
        foreach ($i->alergenos as $a) {
            var_dump($i->id);
            $stmt->execute([$i->id, $a]);
        }
    }

    /**
     * delete
     *
     * @param  mixed $ingrediente
     * @return void
     */
    static public function delete($id)
    {
        $con = Connection::getConection();
        $sql = 'delete from ingredientes where id=?';
        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);
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
        $sql = 'update ingredientes set nombre=?, precio=? where id=?;';
        $stmt = $con->prepare($sql);
        $stmt->execute([$ingrediente->nombre, $ingrediente->precio, $ingrediente->id]);
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
