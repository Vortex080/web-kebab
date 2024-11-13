<?php

class KebabRep implements ICRUD
{

    /**
     * Saca por id
     * @var $id
     */
    static public function getbyId($id)
    {
        $con = Connection::getConection();
        $rest = $con->query('select id, nombre, foto, precio from kebab where id =' . $id . ';');
        while ($row = $rest->fetch()) {
            $ingredientes = IngredientesRep::getAllbyKebab($id);
            $kebab = new Kebab($row['nombre'], $row['foto'], $ingredientes, $row['precio'], $row['id']);
        }

        return $kebab;
    }

    /**
     * getAll
     */
    static public function getAll()
    {
        $con = Connection::getConection();
        $array = [];
        $rest = $con->query('select id, nombre, foto, precio from kebab;');
        while ($row = $rest->fetch()) {
            $ingrediente = IngredientesRep::getAllbyKebab($row['id']);
            $kebab = new Kebab($row['nombre'], $row['foto'], $ingrediente, $row['precio'], $row['id']);
            array_push($array, $kebab);
        }

        return $array;
    }

    /**
     * create
     *
     * @param  mixed $kebab
     * @return void
     */
    static public function create($kebab)
    {
        $con = Connection::getConection();
        try {

            $con->beginTransaction();

            $sql = 'insert into kebab(nombre, foto, precio) values (?, ?, ?)';
            $stmt = $con->prepare($sql);
            $stmt->execute([$kebab->nombre, $kebab->foto, $kebab->precio]);
            $lastId = $con->lastInsertId();
            $kebab->id = $lastId;
            self::addIngredienteKebab($kebab);

            $con->commit();
        } catch (Exception $e) {
            $con->rollBack();
            echo "Ocurrio un error: " . $e->getMessage();
            return null;
        }
    }


    /**
     * delete
     *
     * @param  mixed $kebab
     * @return void
     */
    static public function delete($id)
    {
        $con = Connection::getConection();
        $sql = 'delete from kebab where id=?';
        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);
    }


    /**
     * update
     *
     * @param  mixed $kebab
     * @return void
     */
    static public function update($kebab)
    {
        $con = Connection::getConection();
        $sql = 'update kebab set nombre=?, foto=?, precio=? where id=?;';
        $stmt = $con->prepare($sql);
        $stmt->execute([$kebab->nombre, $kebab->foto, $kebab->precio, $kebab->id]);
    }

    static public function addIngredienteKebab($kebab)
    {
        $con = Connection::getConection();

        $sql = 'insert into kebab_has_ingredientes(id_kebab, id_ingrediente) values (?, ?)';
        $stmt = $con->prepare($sql);
        foreach ($kebab->ingredientes as $a) {
            $stmt->execute([$kebab->id, $a->id]);
        }
    }
}
