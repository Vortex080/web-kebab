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
        $rest = $con->query('select id, nombre, direccion, telefono, email, foto, fecha, estado, idusuario from pedido where id =' . $id . ';');
        while ($row = $rest->fetch()) {

            $pedido = new Pedido($row['id'], $row['nombre'], $row['direccion'], $row['telefono'], $row['email'], $row['foto'], $row['fecha'], $row['estado'], $row['idusuario']);
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
        $rest = $con->query('select id, nombre, direccion, telefono, email, foto, fecha, estado, idusuario from pedido;');
        while ($row = $rest->fetch()) {

            $pedido = new Pedido($row['id'], $row['nombre'], $row['direccion'], $row['telefono'], $row['email'], $row['foto'], $row['fecha'], $row['estado'], $row['idusuario']);
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
        $sql = 'insert into pedido(id, nombre, direccion, telefono, email, foto, fecha, estado, idusuario) values (?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = $con->prepare($sql);
        $stmt->execute([$pedido->id, $pedido->nombre, $pedido->direccion, $pedido->telefono, $pedido->email, $pedido->foto, $pedido->fecha, $pedido->estado, $pedido->idusuario]);
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
        $sql = 'delete from pedido where id=?';
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
        $sql = 'update pedido set nombre=?, direccion=?, telefono=?, email=?, foto=?, fecha=?, estado=?, idusuario=? where id=?';
        $stmt = $con->prepare($sql);
        $stmt->execute([$pedido->nombre, $pedido->direccion, $pedido->telefono, $pedido->email, $pedido->foto, $pedido->fecha, $pedido->estado, $pedido->idusuario, $pedido->id]);
    }

}
