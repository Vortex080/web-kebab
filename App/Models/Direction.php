<?php

class Direction
{
    public $id;
    public $direction;
    public $status;


    public function __construct($id = null, $direction, $status)
    {
        $this->id = $id;
        $this->direction = $direction;
        $this->status = $status;
    }
}
