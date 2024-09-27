<?php
require_once ("prestable.php");

$estadosLegibles = [
    "estado" => ["disponible"=>"Disponible", "prestado"=> "Prestado", "en_preparacion"=> "En Preparación"]
];
abstract class RecursoBiblioteca implements prestable{
    public $id;
    public $titulo;
    public $autor;
    public $anioPublicacion;
    public $estado;
    public $fechaAdquisicion;
    public $tipo;


    public function __construct($datos) {
        foreach ($datos as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function obtenerDetallesPrestamo(){
        return $detallesPrestamo="";
    }

}

// Implementar las clases Libro, Revista y DVD aquí
class Libro extends RecursoBiblioteca implements prestable{
    public $isbn;

    public function __construct($datos, $isbn) {
        parent::__construct($datos);
        $this->isbn = $isbn;
    }

    public function obtenerDetallesPrestamo(){
        return $detallesPrestamo="";
    }
}

class Revista extends RecursoBiblioteca implements prestable{
    public $numeroEdicion;
    public function __construct($datos, $numeroEdicion) {
        parent::__construct($datos);
        $this->numeroEdicion = $numeroEdicion;
    }
    
    public function obtenerDetallesPrestamo(){
        return $detallesPrestamo="";
    }
}

class DVD extends RecursoBiblioteca implements prestable{
    public $duracion;
    public function __construct($datos, $duracion) {
        parent::__construct($datos);
        $this->duracion = $duracion;
    }

    public function obtenerDetallesPrestamo(){
        return $detallesPrestamo="";
    }
}

class GestorBiblioteca extends RecursoBiblioteca {
    private $recursos = [];

    public function cargarRecursos() {
        $json = file_get_contents('biblioteca.json');
        $data = json_decode($json, true);
        
        foreach ($data as $recursoData) {
            foreach ($data as $recursoData) {
                switch ($recursoData['tipo']) {
                    case 'Libro':
                        $recurso = new Libro($recursoData, $recursoData['isbn']);
                        break;
                    case 'Revista':
                        $recurso = new Revista($recursoData, $recursoData['numeroEdicion']);
                        break;
                    case 'DVD':
                        $recurso = new DVD($recursoData, $recursoData['duracion']);
                        break;
                    default:
                        continue;
                }
                $this->recursos[] = $recurso;
        
        return $this->recursos;
    }

    // Implementar los demás métodos aquí
}