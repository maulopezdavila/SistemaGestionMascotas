<?php

//Clase Dueño con sus atributos y métodos
class Dueno {

    //Attributos de Dueño
    public $nombre;
    public $telefono;

    //Constructor que se ejecutara cada vez que se cree un nuevo dueño
    public function __construct($nombre, $telefono) {
        $this->nombre = $nombre; //Se le asignara a "nombre" el valor que llegue en "$nombre"
        $this->telefono = $telefono; //Lo mismo en "telefono"
    }

    //Getter para obtener el nombre del dueño
    public function getNombre(){
        return $this->nombre;
    }
    //Setter para asignar/cambiar el nombre del dueño
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    //Getter y setter respectivamente para el telefono del dueño
    public function getTelefono(){
        return $this->telefono;
    }

    public function setTelefono($telefono){
        $this->telefono=$telefono;
    }
    
}
?>