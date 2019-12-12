<?php

include __DIR__ . "/../vendor/autoload.php";
include 'Operaciones.php';

use Koldown\InversionControl\Contracts\IDependenceFactory;
use Koldown\InversionControl\ClassInstance;
use Koldown\InversionControl\ContainerContext;

class Calculadora {
    
    private $operacion;
    
    public function setOperacion(IOperacionAritmetica $operacion) {
        $this->operacion = $operacion;
    }
    
    public function ejecutar(int $a, int $b) {
        return $this->operacion->ejecutar($a, $b);
    }
}

class DependeceFactory implements IDependenceFactory {
    
    public function build(string $class) {
        switch ($class) {
            case (Calculadora::class) :
                return (new ClassInstance($class))->setDependence("operacion", Resta::class);
                
            default : return new $class();
        }
    }
}

$context = ContainerContext::getInstance();
$sumador = $context->create(DependeceFactory::class, Calculadora::class);

echo "Suma: ".$sumador->ejecutar(9, 11);