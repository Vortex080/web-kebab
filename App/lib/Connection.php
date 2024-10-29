<?php

class Connection
{
    // Objeto connection para conectarse a base de datos
    public static $con = null;
    $config = new Config();

    /**
     * Crea la conexión con la base de datos
     * introduciendo los campos solicitados por el PDO
     */
    public static function getConection()
    {
        if (self::$con == null) {

            try {
                self::$con = new PDO($config->host, $config->user, $config->pass, $config->opciones);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return self::$con;
    }
}