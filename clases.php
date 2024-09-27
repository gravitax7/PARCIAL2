<?php

require_once ("Prestable.php");
class RecursoBiblioteca implements Prestable {
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
}

// Implementar las clases Libro, Revista y DVD aquí
class Libro extends RecursoBiblioteca{
    public $isbn;

    public function __construct($datos, $isbn) {
        parent::__construct($datos);
        $this->isbn = $isbn;
    }
}

class Revista extends RecursoBiblioteca{
    public $numeroEdicion;
    public function __construct($datos, $numeroEdicion) {
        parent::__construct($datos);
        $this->numeroEdicion = $numeroEdicion;
    }
}

class DVD extends RecursoBiblioteca{
    public $duracion;
    public function __construct($datos, $duracion) {
        parent::__construct($datos);
        $this->duracion = $duracion;
    }
}



class GestorBiblioteca {
    private $recursos = [];

    public function cargarRecursos() {
        $json = file_get_contents('biblioteca.json');
        $data = json_decode($json, true);
        
        foreach ($data as $recursoData) {
            $recurso = new RecursoBiblioteca($recursoData);
            $this->recursos[] = $recurso;
        }
        
        return $this->recursos;
    }

    // Implementar los demás métodos aquí
}