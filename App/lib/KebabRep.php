<?php

class UserRep implements ICRUD{

    /**
     * Saca por id
     * @var $id
     */
    static public function getbyId($id)
    {
        $con = Connection::getConection();
        $rest = $con->query('select id, nombre, foto from kebab where id =' . $id . ';');
        $resting = $con->query('select ')
        while ($row = $rest->fetch()) {

            $kebab = new Kebab($row['id'], $row['nombre'], $row['foto']);
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

            $kebab = new Kebab($row['id'], $row['nombre'], $row['foto']);
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
        $sql = 'insert into kebab(id, nombre, foto) values (?, ?, ?)';
        $stmt = $con->prepare($sql);
        $stmt->execute([$kebab->id, $kebab->nombre, $kebab->foto]);
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
        $sql = 'update kebab set nombre=?, foto=? where id='.$kebab->id.';';
        $stmt = $con->prepare($sql);
        $stmt->execute($kebab->nombre, $kebab->foto);
    }
}
