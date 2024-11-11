<?php

class PedidosRep implements ICRUD
{

    /**
     * Saca por id
     * @var $id
     */
    static public function getbyId($id)
    {
        $con = Connection::getConection();
        $rest = $con->query('select id, fecha, estado, precio, direction, userid from pedidos where id =' . $id . ';');
        while ($row = $rest->fetch()) {
            $lineas = self::getAllByPedido($row['id']);
            $pedido = new Pedido($row['fecha'], $row['estado'], $row['precio'], $row['direction'], $row['userid'], $lineas, $row['id']);
        }

        return $pedido;
    }

    /**
     * getAll
     */
    static public function getAll()
    {
        $con = Connection::getConection();
        $array = [];
        $rest = $con->query('select id, fecha, estado, precio, direcction, user, lineas from pedidos;');
        while ($row = $rest->fetch()) {
            $pedido = new Pedido($row['id'], $row['fecha'], $row['estado'], $row['precio'], $row['direcction'], $row['user'], $row['lineas']);
            array_push($array, $pedido);
        }

        return $array;
    }

    /**
     * create
     *
     * @param  mixed $pedido
     * @return void
     */
    static public function create($pedido)
    {
        $con = Connection::getConection();
        try {
            $con->beginTransaction();

            $sql = 'insert into pedidos(id, fecha, estado, precio, direction, userid) values (?, ?, ?, ?, ?, ?)';
            $stmt = $con->prepare($sql);
            $direcion = json_encode($pedido->direcction);
            $stmt->execute([$pedido->id, $pedido->fecha, $pedido->estado, $pedido->precio, $direcion, $pedido->user->id]);

            $nuevoIdPedido = $con->lastInsertId();
            foreach ($pedido->lineas as $a) {

                $linea = new LineaPedido($a->cantidad, $a->producto, $a->precio, $nuevoIdPedido, null);
                LineaPedidoRep::addpedido($linea);
            }

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
     * @param  mixed $pedido
     * @return void
     */
    static public function delete($id)
    {
        $con = Connection::getConection();
        $sql = 'delete from pedidos where id=?';
        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);
    }


    /**
     * update
     *
     * @param  mixed $pedido
     * @return void
     */
    static public function update($pedido)
    {
        $con = Connection::getConection();
        $sql = 'update pedidos set fecha=?,estado=?,precio=?,direction=?,userid=? where id=?;';
        $stmt = $con->prepare($sql);
        $direcction = json_encode($pedido->direcction);
        $stmt->execute([$pedido->fecha, $pedido->estado, $pedido->precio, $direcction, $pedido->user->id, $pedido->id]);
        foreach ($pedido->lineas as $linea) {
            var_dump($linea);
            LineaPedidoRep::update($linea);
        }
    }


    /**
     * getbykebab
     */
    static public function getAllByPedido($id)
    {
        $con = Connection::getConection();
        $array = [];
        $rest = $con->query('select id, cantidad, producto, precio from lineapedido where pedidoid=' . $id . ';');
        while ($row = $rest->fetch()) {
            $pedido = new LineaPedido($row['cantidad'], $row['producto'], $row['precio'], $id, $row['id']);
            array_push($array, $pedido);
        }

        return $array;
    }
}
