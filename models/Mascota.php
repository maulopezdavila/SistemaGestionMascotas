<?php

//Clase Mascota con sus atributos y métodos
class Mascota {

    //Los atributos de la clase Mascota
    public $nombre;
    public $especie;

    //Arrays vacios para poder guardar los duueños y las visitas
    public $duenos = [];
    public $visitas = [];

    //Constructor que se ejecutara cada vez que se cree una nueva mascota
    public function __construct($nombre, $especie) {
        
        $this->nombre = $nombre; //Se le asignara a "nombre" el valor que llegue en "$nombre"
        $this->especie = $especie; //Lo misomo en "especie"
    }

    //Getter para devolver el nombre acutal de la mascota cuando se llame a la función
    public function getNombre(){
        return $this->nombre;
    }
    //Setter para asignar/cambiar el nombre de la mascota.
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    //Los demas metodos para "especie"
    public function getEspecie(){
        return $this->especie;
    }
    public function setEspecie($especie){
        $this->especie = $especie;
    }


    //Getter para obtener los dueños de la mascota
    public function getDuenos(){
        return $this->duenos;
    }
    //Metodos setter ya existentes del código original
    public function agregarDueno($dueno) {
        $this->duenos[] = $dueno;
    }

    //Getter para obtener las visitas de la mascota
    public function getVisitas(){
        return $this->visitas;
    }
    //Metodo setter ya existente en el código original
    public function agregarVisita($visita) {
        $this->visitas[] = $visita;
    }
}
?>