<?php

class Restador implements IOperador {
    
    // Atributos de la clase Restador
    
    /**
     *
     * @var IOperacionAritmetica 
     */
    private $operacion;
    
    // Métodos sobrescritos de la interfaz ICalculadora

    public function setOperacion(IOperacionAritmetica $operacion): void {
        $this->operacion = $operacion;
    }
    
    public function ejecutar(int $a, int $b): int {
        return $this->operacion->ejecutar($a, $b);
    }
}