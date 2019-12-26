<?php

use Koldown\InversionControl\Contracts\IDependenceFactory;
use Koldown\InversionControl\ClassInstance;

class Factory implements IDependenceFactory {
    
    public function build(string $class) {
        switch ($class) {
            case (Sumador::class) :
                return (new ClassInstance(Sumador::class))->setDependence("operacion", Suma::class);
                
            case (Restador::class) :
                return (new ClassInstance(Restador::class))->setDependence("operacion", Resta::class);
                
            case (Calculadora::class) :
                return (new ClassInstance(Calculadora::class))
                    ->setDependence("restador", Restador::class)
                    ->setDependence("sumador", Sumador::class);
                
            default : return new $class();
        }
    }
}