<?php

class Config
{

    public static $host = 'mysql:localhost;port=3306;dbname=cars';
    public static $user = 'root';
    public static $pass = '';
    public static $options = 'array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")';
}
