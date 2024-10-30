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

            $direction = new Direction($row['id'], $row['direction'], $row['estado']);
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
        $sql = 'insert into direction(id, direction, estado) values (?, ?, ?)';
        $stmt = $con->prepare($sql);
        $stmt->execute([$direction->id, $direction->direction, $direction->estado]);
    }


    /**
     * delete
     *
     * @param  mixed $direction
     * @return void
     */
    static public function delete($direction)
    {
        $con = Connection::getConection();
        $sql = 'delete from direction where id=?';
        $stmt = $con->prepare($sql);
        $stmt->execute([$direction->id]);
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
        $stmt->execute($direction->direction, $direction->estado);
    }
}
