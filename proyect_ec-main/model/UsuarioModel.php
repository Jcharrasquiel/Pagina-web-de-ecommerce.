<?php

class UsuarioModel
{
    public $id;
    public $documento;
    public $nombre;
    public $apellido;
    public $direccion;
    public $telefono;
    public $usuario;
    public $pass;
    public $rol;

    public function __construct($_id,$doc,$nom,$ape,$dir,$tel,$us,$pass,$rol)
    {
        $this->id = $_id;
        $this->documento = $doc;
        $this->nombre = $nom;
        $this->apellido = $ape;
        $this->direccion = $dir;
        $this->telefono = $tel;
        $this->usuario  = $us;
        $this->pass = $pass;
        $this->rol = $rol;
    }
}
