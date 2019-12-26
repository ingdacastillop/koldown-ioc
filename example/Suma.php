<?php

class Suma implements IOperacionAritmetica {
    
    /**
     * 
     * @param int $a
     * @param int $b
     * @return int
     */
    public function ejecutar(int $a, int $b): int {
        return $a + $b;
    }
}