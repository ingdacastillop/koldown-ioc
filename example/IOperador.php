<?php

interface IOperador {
    
    /**
     * 
     * @param IOperacionAritmetica $operacion
     * @return void
     */
    public function setOperacion(IOperacionAritmetica $operacion): void;
    
    /**
     * 
     * @param int $a
     * @param int $b
     * @return int
     */
    public function ejecutar(int $a, int $b): int;
}