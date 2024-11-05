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
        $rest = $con->query('select id, fecha, estado, precio, direcction, user, lineas from pedidos where id =' . $id . ';');
        while ($row = $rest->fetch()) {

            $pedido = new Pedido($row['id'], $row['fecha'], $row['estado'], $row['precio'], $row['direcction'], $row['user'], $row['lineas']);
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
        $sql = 'insert into pedidos(id, fecha, estado, precio, direction, userid) values (?, ?, ?, ?, ?, ?, ?)';
        $stmt = $con->prepare($sql);
        $stmt->execute([$pedido->id, $pedido->fecha, $pedido->estado, $pedido->precio, $pedido->direcction, $pedido->user]);
    }


    /**
     * delete
     *
     * @param  mixed $pedido
     * @return void
     */
    static public function delete($pedido)
    {
        $con = Connection::getConection();
        $sql = 'delete from pedidos where id=?';
        $stmt = $con->prepare($sql);
        $stmt->execute([$pedido->id]);
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
        $sql = 'update pedidos set fecha=?, estado=?, precio=?, direcction=?, user=?, lineas=? where id=' . $pedido->id . ';';
        $stmt = $con->prepare($sql);
        $stmt->execute($pedido->fecha, $pedido->estado, $pedido->precio, $pedido->direcction, $pedido->user, $pedido->lineas);
    }


    /**
     * getbykebab
     */
    static public function getAllbyKebab($id)
    {
        $con = Connection::getConection();
        $array = [];
        $rest = $con->query('select id_ingrediente from kebab_has_ingredientes where id_kebab=' . $id . ';');
        while ($row = $rest->fetch()) {

            $ingrediente = IngredientesRep::getbyId($row['id_ingrediente']);

            array_push($array, $ingrediente);
        }

        return $array;
    }
}
