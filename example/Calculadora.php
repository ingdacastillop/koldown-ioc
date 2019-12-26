<?php

class Calculadora {
    
    // Atributos de la clase Calculadora
    
    /**
     *
     * @var IOperador 
     */
    private $sumador;
    
    /**
     *
     * @var IOperador 
     */
    private $restador; 
    
    // Métodos de la clase Calculadora
    
    /**
     * 
     * @param IOperador $sumador
     * @return void
     */
    public function setSumador(IOperador $sumador): void {
        $this->sumador = $sumador;
    }
    
    /**
     * 
     * @param IOperador $restador
     * @return void
     */
    public function setRestador(IOperador $restador): void {
        $this->restador = $restador;
    }
    
    /**
     * 
     * @param int $a
     * @param int $b
     * @return int
     */
    public function sumar(int $a, int $b): int {
        return $this->sumador->ejecutar($a, $b);
    }
    
    /**
     * 
     * @param int $a
     * @param int $b
     * @return int
     */
    public function restar(int $a, int $b): int {
        return $this->restador->ejecutar($a, $b);
    }
}