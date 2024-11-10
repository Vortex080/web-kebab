<?php

class DirectionRep implements ICRUD
{

    /**
     * Saca por id
     * @var $id
     */
    static public function getbyId($id)
    {
        $con = Connection::getConection();
        $rest = $con->query('select id, direction, estado from direction where id =' . $id . ';');
        while ($row = $rest->fetch()) {

            $direction = new Direction($row['direction'], $row['estado'], $row['id']);
        }

        return $direction;
    }

    /**
     * getAll
     */
    static public function getAll()
    {
        $con = Connection::getConection();
        $array = [];
        $rest = $con->query('select id, direction, estado from direction;');
        while ($row = $rest->fetch()) {

            $direction = new Direction($row['id'], $row['direction'], $row['estado']);
            array_push($array, $direction);
        }

        return $array;
    }

    /**
     * create
     *
     * @param  mixed $direction
     * @return void
     */
    static public function create($direction)
    {
        $con = Connection::getConection();
        try {
            $con->beginTransaction();
            $sql = 'insert into direction(direction, estado) values (?, ?)';
            $stmt = $con->prepare($sql);
            $stmt->execute([$direction->direction, $direction->status]);

            $lastId = $con->lastInsertId();

            $con->commit();

            return $lastId;
        } catch (Exception $e) {
            $con->rollBack();
            echo "Ocurrio un error: " . $e->getMessage();
            return null;
        }
    }


    /**
     * delete
     *
     * @param  mixed $direction
     * @return void
     */
    static public function delete($id)
    {
        $con = Connection::getConection();
        $sql = 'delete from direction where id=?';
        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);
    }


    /**
     * update
     *
     * @param  mixed $direction
     * @return void
     */
    static public function update($direction)
    {
        $con = Connection::getConection();
        $sql = 'update direction set direction=?, estado=? where id=' . $direction->id . ';';
        $stmt = $con->prepare($sql);
        $stmt->execute([$direction->direction, $direction->status]);
    }
}
