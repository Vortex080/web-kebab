<?php

class Direcction
{
    public static $id;
    public static $direction;
    public static $status;
    public static $userId;


    public function __construct($id = null, $direction, $status, $userId)
    {
        $this->id = $id;
        $this->direction = $direction;
        $this->status = $status;
        $this->userId = $userId;
    }
}
