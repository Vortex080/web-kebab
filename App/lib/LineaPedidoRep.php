<?php
class LineaPedidoRep implements ICRUD
{
    /**
     * Saca por id
     * @var $id
     */
    static public function getbyId($id)
    {
        $con = Connection::getConection();
        $rest = $con->query('select id, cantidad, producto, precio, pedidoid from lineapedido where id =' . $id . ';');
        while ($row = $rest->fetch()) {
            $linea = new LineaPedido($row['id'], $row['cantidad'], $row['producto'], $row['precio'], $row['pedidoid']);
        }

        return $linea;
    }

    /**
     * getAll
     */
    static public function getAll()
    {
        $con = Connection::getConection();
        $array = [];
        $rest = $con->query('select id, cantidad, producto, precio, pedidoid from lineapedido;');
        while ($row = $rest->fetch()) {
            $linea = new LineaPedido($row['id'], $row['cantidad'], $row['producto'], $row['precio'], $row['pedidoid']);
            array_push($array, $linea);
        }

        return $array;
    }

    /**
     * create
     *
     * @param  mixed $linea
     * @return void
     */
    static public function create($linea)
    {
        $con = Connection::getConection();
        $sql = 'insert into lineapedido(cantidad, producto, precio, pedidoid) values (?, ?, ?, ?, ?)';
        $stmt = $con->prepare($sql);
        $stmt->execute([$linea->cantidad, $linea->producto, $linea->precio, $linea->pedidoid]);
    }


    /**
     * delete
     *
     * @param  mixed $linea
     * @return void
     */
    static public function delete($linea)
    {
        $con = Connection::getConection();
        $sql = 'delete from lineapedido where id=?';
        $stmt = $con->prepare($sql);
        $stmt->execute([$linea->id]);
    }


    /**
     * update
     *
     * @param  mixed $linea
     * @return void
     */
    static public function update($linea)
    {
        $con = Connection::getConection();
        $sql = 'update lineapedido set cantidad=?, producto=?, precio=?, pedidoid=? where id=' . $linea->id . ';';
        $stmt = $con->prepare($sql);
        $stmt->execute($linea->cantidad, $linea->producto, $linea->precio, $linea->pedidoid);
    }

    static public function addpedido($l)
    {
        $con = Connection::getConection();

        $sql = 'insert into lineapedido(cantidad, producto, precio, pedidoid) values (?, ?, ?, ?)';
        $stmt = $con->prepare($sql);
        $producto = json_encode($l->producto);
        $stmt->execute([$l->cantidad, $producto, $l->precio, $l->pedidoid]);
    }
}
