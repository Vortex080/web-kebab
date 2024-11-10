<?php

class Direction
{
    public $id;
    public $direction;
    public $status;


    public function __construct($direction, $status, $id = null)
    {
        $this->id = $id;
        $this->direction = $direction;
        $this->status = $status;
    }
}
