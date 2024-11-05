<?php

class Direcction
{
    public $id;
    public $direction;
    public $status;
    public $userId;


    public function __construct($id = null, $direction, $status, $userId)
    {
        $this->id = $id;
        $this->direction = $direction;
        $this->status = $status;
        $this->userId = $userId;
    }
}
