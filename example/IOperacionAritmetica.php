<?php

interface IOperacionAritmetica {
    
    /**
     * 
     * @param int $a
     * @param int $b
     * @return int
     */
    public function ejecutar(int $a, int $b): int;
}