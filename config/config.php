<?php

class Config
{
    public $host = 'mysql:localhost;port=3306;dbname=kebab';
    public $user = 'root';
    public $pass = '';
    public $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
}
