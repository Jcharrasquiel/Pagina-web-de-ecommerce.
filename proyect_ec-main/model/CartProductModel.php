<?php


class CartProductModel
{
    
    public $id;
    public $nombre;
    public $stock;
    public $total;


    public function __construct($_id,$nom,$stock,$total)
    {
        $this->total = $total;
        $this->id= $_id;
        $this->nombre = $nom;
        $this->stock  = $stock;

    }

    public function getId()
    {
        return $id;
    }
}
