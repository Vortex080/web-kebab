<?php

class UserRep implements ICRUD{

    /**
     * Saca por id
     * @var $id
     */
    static public function getbyId($id)
    {
        $con = Connection::getConection();
        $rest = $con->query('select id, nombre, pass, monedero, foto, direction from usuario where id =' . $id . ';');
        while ($row = $rest->fetch()) {

            $user = new User($row['id'], $row['nombre'], $row['pass'], $row['monedero'], $row['foto'], $row['direction']);
        }

        return $user;
    }

    /**
    * getAll
    */
    static public function getAll()
    {
        $con = Connection::getConection();
        $array = [];
        $rest = $con->query('select id, nombre, pass, monedero, foto, direction from usuario;');
        while ($row = $rest->fetch()) {

            $user = new User($row['id'], $row['nombre'], $row['pass'], $row['monedero'], $row['foto'], $row['direction']);
            array_push($array, $user);
        }

        return $array;
    }

    /**
     * create
     *
     * @param  mixed $user
     * @return void
     */
    static public function create($user)
    {
        $con = Connection::getConection();
        $sql = 'insert into usuario(id, nombre, pass, monedero, foto, direction) values (?, ?, ?, ?, ?, ?)';
        $stmt = $con->prepare($sql);
        $stmt->execute([$user->id, $user->nombre, $user->pass, $user->monedero, $user->foto, $user->direction]);
    }


    /**
     * delete
     *
     * @param  mixed $user
     * @return void
     */
    static public function delete($user)
    {
        $con = Connection::getConection();
        $sql = 'delete from usuario where id=?';
        $stmt = $con->prepare($sql);
        $stmt->execute([$user->id]);
    }


    /**
     * update
     *
     * @param  mixed $user
     * @return void
     */
    static public function update($user)
    {
        $con = Connection::getConection();
        $sql = 'update usuario set nombre=?, pass=?, monedero=?, foto=?, direction=? where id='.$user->id.';';
        $stmt = $con->prepare($sql);
        $stmt->execute($user->nombre, $user->pass, $user->monedero, $user->foto, $user->direction);
    }
}
