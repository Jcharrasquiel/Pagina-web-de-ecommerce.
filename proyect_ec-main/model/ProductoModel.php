<?php

class ProductoModel
{
    public $id;
    public $codigo;
    public $nombre;
    public $descripcion;
    public $precV;
    public $precC;
    public $stock;
    public $img;
    public $categoria;

    public function __construct($_id,$codigo,$nombre,$descripcion,$precV,$precC,$stock,$img,$categoria)
    {
        $this->id = $_id;
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precV = $precV;
        $this->precC = $precC;
        $this->stock = $stock;
        $this->img = $img;
        $this->categoria = $categoria;
    }
}
