<?php

class UserRep implements ICRUD
{

    /**
     * Saca por id
     * @var $id
     */
    static public function getbyId($id)
    {
        $con = Connection::getConection();
        $rest = $con->query('select id, nombre, pass, monedero, foto, direction from usuario where id =' . $id . ';');
        while ($row = $rest->fetch()) {
            $alergenos = self::getAlergenosbyId($row['id']);
            $user = new User($row['nombre'], $row['pass'], $row['monedero'], $row['foto'], $row['direction'], $alergenos, $row['id']);
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
            $alergenos = self::getAlergenosbyId($row['id']);
            $user = new User($row['nombre'], $row['pass'], $row['monedero'], $row['foto'], $row['direction'], $alergenos, $row['id']);
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

        try {

            $con->beginTransaction();

            // Insertar usuario
            $sql = 'insert into usuario(nombre, pass, monedero, foto, direction) values (?, ?, ?, ?, ?)';
            $stmt = $con->prepare($sql);
            $stmt->execute([$user->nombre, $user->pass, $user->monedero, $user->foto, $user->direcction->id]);

            $nuevoID = $con->lastInsertId();


            $user->id = $nuevoID;
            self::addAlergenos($user);


            $con->commit();

            return $nuevoID;
        } catch (Exception $e) {
            $con->rollBack();
            echo "Ocurrio un error: " . $e->getMessage();
            return null;
        }
    }


    /**
     * delete
     *
     * @param  mixed $user
     * @return void
     */
    static public function delete($id)
    {
        $con = Connection::getConection();
        $sql = 'delete from usuario where id=?';
        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);
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
        $sql = 'update usuario set nombre=?, pass=?, monedero=?, foto=?, direction=? where id=' . $user->id . ';';
        $stmt = $con->prepare($sql);
        $stmt->execute([$user->nombre, $user->pass, $user->monedero, $user->foto, $user->direcction->id]);
    }


    static public function getAlergenosbyId($id)
    {
        $con = Connection::getConection();
        $rest = $con->query('select idUsuario, idAlergeno from usuario_has_alergenos where idUsuario =' . $id . ';');
        while ($row = $rest->fetch()) {

            $idaleg = $row['idAlergeno'];
            $alergeno = AlergenosRep::getbyId($idaleg);
        }

        return $alergeno;
    }


    static public function addAlergenos($user)
    {
        $con = Connection::getConection();
        try {
            $sql = 'insert into usuario_has_alergenos(idUsuario, idAlergeno) values (?, ?)';
            $stmt = $con->prepare($sql);
            foreach ($user->alergenos as $a) {
                $stmt->execute([$user->id, $a->id]);
            }

            return $user->alergenos;
        } catch (Exception $e) {
            $con->rollBack();
            echo "Ocurrio un error: " . $e->getMessage();
            return null;
        }
    }
}
