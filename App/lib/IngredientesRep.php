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
        $rest = $con->query('select id, nombre, precio, foto from ingredientes where id =' . $id . ';');
        while ($row = $rest->fetch()) {

            $alergenos = AlergenosRep::getAllbyingrediente($id);
            $ingrediente = new Ingredientes($row['nombre'], $row['precio'], $row['foto'], $row['id'], $alergenos);
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
        $rest = $con->query('select id, nombre, precio, foto from ingredientes where nombre =' . $nombre . ';');
        while ($row = $rest->fetch()) {

            $alergenos = AlergenosRep::getAllbyingrediente($row['id']);
            $ingrediente = new Ingredientes($row['nombre'], $row['precio'], $row['foto'], $row['id'], $alergenos);
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
        $rest = $con->query('select id, nombre, precio, foto from ingredientes;');
        while ($row = $rest->fetch()) {
            $alergenos = AlergenosRep::getAllbyingrediente($row['id']);
            $ingrediente = new Ingredientes($row['nombre'], $row['precio'], $row['foto'], $row['id'], $alergenos);
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

        try {

            $con->beginTransaction();

            // Insertar ingrediente
            $sql = 'insert into ingredientes(nombre, precio, foto) values (?, ?, ?)';
            $stmt = $con->prepare($sql);
            $stmt->execute([$ingrediente->nombre, $ingrediente->precio, $ingrediente->foto]);

            $nuevoID = $con->lastInsertId();


            $ingrediente->id = $nuevoID;
            self::insertIngredienteHasAlergenos($ingrediente);


            $con->commit();

            return $nuevoID;
        } catch (Exception $e) {
            $con->rollBack();
            echo "Ocurrio un error: " . $e->getMessage();
            return null;
        }
    }


    public static function insertIngredienteHasAlergenos($i)
    {
        $con = Connection::getConection();
        try {
            $sql = 'insert into ingredientes_has_alergenos(id_ingrediente, id_alergenos) values (?, ?)';
            $stmt = $con->prepare($sql);
            foreach ($i->alergenos as $a) {
                $stmt->execute([$i->id, $a->id]);
            }

            return $i->alergenos;
        } catch (Exception $e) {
            $con->rollBack();
            echo "Ocurrio un error: " . $e->getMessage();
            return null;
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
        $sql = 'update ingredientes set nombre=?, precio=?, foto=? where id=?;';
        $stmt = $con->prepare($sql);
        self::deleteAllAlergenosbyIngrediente($ingrediente);
        self::addAlergenoIngrediente($ingrediente);
        $stmt->execute([$ingrediente->nombre, $ingrediente->precio, $ingrediente->foto, $ingrediente->id]);
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

    static public function addAlergenoIngrediente($ingrediente)
    {
        $con = Connection::getConection();

        $sql = 'insert into ingredientes_has_alergenos(id_ingrediente, id_alergenos) values (?, ?)';
        $stmt = $con->prepare($sql);
        foreach ($ingrediente->alergenos as $a) {
            $stmt->execute([$ingrediente->id, $a->id]);
        }
    }

    static public function deleteAllAlergenosbyIngrediente($ingrediente)
    {
        $con = Connection::getConection();

        $sql = 'delete from  ingredientes_has_alergenos where id_ingrediente=?';
        $stmt = $con->prepare($sql);
        $stmt->execute([$ingrediente->id]);
    }
}
