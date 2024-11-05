<?php


class AlergenosRep implements ICRUD
{

    /**
     * Saca por id
     * @var $id
     */
    static public function getbyId($id)
    {
        $con = Connection::getConection();
        $rest = $con->query('select id, nombre, foto from alergenos where id =' . $id . ';');
        while ($row = $rest->fetch()) {

            $alergeno = new Alergenos($row['id'], $row['nombre'], $row['foto']);
        }

        return $alergeno;
    }

    /**
     * getAll
     */
    static public function getAll()
    {
        $con = Connection::getConection();
        $array = [];
        $rest = $con->query('select id, nombre, foto from alergenos;');
        while ($row = $rest->fetch()) {

            $alergenos = new Alergenos($row['id'], $row['nombre'], $row['foto']);
            array_push($array, $alergenos);
        }

        return $array;
    }

    /**
     * create
     *
     * @param  mixed $alergenos
     * @return void
     */
    static public function create($alergenos)
    {
        $con = Connection::getConection();
        $sql = 'insert into alergenos(id, nombre, foto) values (?, ?, ?)';
        $stmt = $con->prepare($sql);
        $stmt->execute([$alergenos->id, $alergenos->nombre, $alergenos->foto]);
    }


    /**
     * delete
     *
     * @param  mixed $alergenos
     * @return void
     */
    static public function delete($id)
    {
        $con = Connection::getConection();
        $sql = 'delete from alergenos where id=?';
        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);
    }

    /**
     * update
     *
     * @param  mixed $alergenos
     * @return void
     */
    static public function update($alergenos)
    {
        $con = Connection::getConection();
        $sql = 'update alergenos set nombre=?, foto=? where id=?;';
        $stmt = $con->prepare($sql);
        $stmt->execute([$alergenos->nombre, $alergenos->foto, $alergenos->id]);
    }

    /**
     * getbyingrediente
     */
    static public function getAllbyingrediente($id)
    {
        $con = Connection::getConection();
        $array = [];
        $rest = $con->query('select id_alergeno from ingredientes_has_alergenos where id_ingrediente=' . $id . ';');
        while ($row = $rest->fetch()) {

            $alergenos = AlergenosRep::getbyId($row['id_alergeno']);

            array_push($array, $alergenos);
        }

        return $array;
    }
}
