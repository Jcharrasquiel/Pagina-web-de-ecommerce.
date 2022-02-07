<?php

class CategoriaModel
{
    public $id;
    public $nombre;

    function __construct($_id, $_nombre)
    {
        $this->id = $_id;
        $this->nombre = $_nombre;
    }
}
