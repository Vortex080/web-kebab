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
        $rest = $con->query('select id, nombre, pass, monedero, foto, direction, email, rol, carrito from usuario where id =' . $id . ';');
        while ($row = $rest->fetch()) {
            $alergenos = self::getAlergenosbyId($row['id']);
            $user = new User($row['nombre'], $row['pass'], $row['monedero'], $row['foto'], $row['email'], $row['rol'], $row['direction'], $alergenos, $row['carrito'], $row['id']);
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
        $rest = $con->query('select id, nombre, pass, monedero, foto, direction, email, rol, carrito from usuario;');
        while ($row = $rest->fetch()) {
            $alergenos = self::getAlergenosbyId($row['id']);
            $user = new User($row['nombre'], $row['pass'], $row['monedero'], $row['foto'], $row['email'], $row['rol'], $row['direction'], $alergenos, $row['carrito'], $row['id']);
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
            $sql = 'insert into usuario(nombre, pass, monedero, foto, direction, rol, email, carrito) values (?, ?, ?, ?, ?, ?, ?)';
            $stmt = $con->prepare($sql);
            $stmt->execute([$user->nombre, $user->pass, $user->monedero, $user->foto, $user->direcction->id, $user->rol, $user->email, $user->carrito->id]);

            $nuevoID = $con->lastInsertId();


            $user->id = $nuevoID;
            self::addAlergenos($user);


            $con->commit();

            MailHog::sendMail('admin@mailhog.com', 'Bienvenido ', $user->nombre . ' Ya te has rergistrado en KebabAmigo, disfruta de nuestros maravillosos productos y de nuestras ofertas');

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
        $sql = 'update usuario set nombre=?, pass=?, monedero=?, foto=?, direction=?, rol=?, email=?, carrito=? where id=' . $user->id . ';';
        $stmt = $con->prepare($sql);
        if(isset($user->direction->id)){
            $direction = $user->direcction->id;
        } else{
            $direction = $user->direcction;
        }

        $stmt->execute([$user->nombre, $user->pass, $user->monedero, $user->foto, $direction, $user->rol, $user->email, $user->carrito]);
    }


    static public function getAlergenosbyId($id)
    {
        $con = Connection::getConection();
        $alergenos = [];
        $rest = $con->query('select idUsuario, idAlergeno from usuario_has_alergenos where idUsuario =' . $id . ';');
        while ($row = $rest->fetch()) {

            $idaleg = $row['idAlergeno'];
            $alergenos = AlergenosRep::getbyId($idaleg);
        }

        return $alergenos;
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


    public static function addcarrito($id, $carrito)
    {
        $con = Connection::getConection();

        $user = self::getbyId($id);

        if ($user->carrito == null) {
            $user->carrito = $carrito;
        } else {
            $user->carrito = array_push($user->carrito, $carrito);
        }
        // Insertar usuario
        $sql = 'insert into usuario(nombre, pass, monedero, foto, direction, rol, email, carrito) values (?, ?, ?, ?, ?, ?, ?)';
        $stmt = $con->prepare($sql);
        $stmt->execute([$user->nombre, $user->pass, $user->monedero, $user->foto, $user->direcction->id, $user->rol, $user->email, $user->carrito]);
    }
}
