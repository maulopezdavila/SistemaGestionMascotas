<?php

//Clase VisitaMedica con sus atributos y métodos
class VisitaMedica {

    //Atributos de la clase 
    public $fecha;
    public $diagnostico;
    public $tratamiento;

    //Constructor que se ejecutara cada vez que se cree una nueva visita medica (Parte del código original)
    public function __construct($fecha, $diagnostico, $tratamiento) {
        $this->fecha = $fecha;
        $this->diagnostico = $diagnostico;
        $this->tratamiento = $tratamiento;
    }

    
    //Metodos para la fecha
    public function getFecha(){
        return $this->fecha;
    }

    public function setFecha($fecha){
        $this->fecha=$fecha;
    }


    //Metodos para el diagnostico
    public function getDiagnostico(){
        return $this->diagnostico;
    }

    public function setDiagnostico($diagnostico){
        $this->diagnostico=$diagnostico;
    }


    //Metodos para el tratamiento
    public function getTratamiento(){
        return $this->tratamiento;
    }

    public function setTratamiento($tratamiento){
        $this->tratamiento=$tratamiento;
    }
}
?>