<?php

interface IOperacionAritmetica {
    
    public function ejecutar(int $a, int $b): int;
}

class Suma implements IOperacionAritmetica {
    
    public function ejecutar(int $a, int $b): int {
        return $a + $b;
    }
}

class Resta implements IOperacionAritmetica {
    
    public function ejecutar(int $a, int $b): int {
        return $a - $b;
    }
}