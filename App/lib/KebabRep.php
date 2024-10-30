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
        $rest = $con->query('select id, nombre, foto from kebab where id =' . $id . ';');
        while ($row = $rest->fetch()) {
            $ingredientes = IngredientesRep::getAllbyKebab($id);
            $kebab = new Kebab($row['id'], $row['nombre'], $row['foto'], $ingredientes, $row['precio']);
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
        $rest = $con->query('select id, nombre, foto from kebab;');
        while ($row = $rest->fetch()) {
            $ingrediente = IngredientesRep::getAllbyKebab($row['id']);
            $kebab = new Kebab($row['id'], $row['nombre'], $row['foto'], $ingrediente, $row['precio']);
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
        $sql = 'insert into kebab(id, nombre, foto, precio) values (?, ?, ?, ?)';
        $stmt = $con->prepare($sql);
        $stmt->execute([$kebab->id, $kebab->nombre, $kebab->foto, $kebab->precio]);
        foreach ($kebab->ingrediente as $i) {
            $sql2 = 'insert into kebab_has_ingredientes(id_kebab, id_ingrediente) values (?, ?)';
            $stmt = $con->prepare($sql2);
            $stmt->execute([$kebab->id, $i->id]);
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
        $stmt->execute([$kebab->id]);
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
        $sql = 'update kebab set nombre=?, foto=?, precio=? where id=' . $kebab->id . ';';
        $stmt = $con->prepare($sql);
        $stmt->execute($kebab->nombre, $kebab->foto, $kebab->precio);
    }
}
