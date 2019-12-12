<?php

namespace Koldown\InversionControl\Contracts;

interface IDependenceFactory {
    
    // Métodos de la interface IDependenceFactory
    
    /**
     * Permite construir una instancia de la clase establecida
     * con sus respectivas dependencias
     * 
     * @param string $class Clase que se necesita instanciar
     * @return mixed Instancia de clase generada
     */
    public function build(string $class);
}