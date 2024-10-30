<?php

class Connection
{
    // Objeto connection para conectarse a base de datos
    public static $con = null;
    public static $config = new Config();

    /**
     * Crea la conexión con la base de datos
     * introduciendo los campos solicitados por el PDO
     */
    public static function getConection()
    {
        if (self::$con == null) {

            try {
                self::$con = new PDO(self::$config->host, self::$config->user, self::$config->pass, self::$config->options);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return self::$con;
    }
}
