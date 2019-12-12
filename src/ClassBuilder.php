<?php

namespace Koldown\InversionControl;

use ReflectionClass;
use ReflectionMethod;

class ClassBuilder {
    
    // Métodos de la clase ClassBuilder
    
    /**
     * Permite construir un objeto con sus respectivas dependencias
     * 
     * @param ClassInstance $class Parámetro de clase a construir
     * @param ContainerContext $context Contexto contenedor
     * @param string $classFactory Nombre de clase de factoría de dependencias
     * @return mixed Objeto creado con sus dependencias
     */
    public function create(ClassInstance $class, ContainerContext $context, string $classFactory) {
        $classInstance = $this->build($class->getClass()); // Instancia

        $reflection    = new ReflectionClass($classInstance);
        
        foreach ($class->getDependences() as $attrName => $dependence) {
            $setter   = $this->getMethodName($attrName); // Nombre del Método
                
            $injector = $this->getDependenceInjector($reflection, $setter);

            if (!is_null($injector)) {
                $injector->invoke($classInstance, $this->createDependence($dependence, $context, $classFactory, $attrName));
            } // Inyectando dependencia en clase en construcción
        }
        
        return $classInstance; // Retornando instancia de la clase
    }
    
    /**
     * Permite obtener el método para realizar la inyección de la dependencia
     * 
     * @param ReflectionClass $reflection Reflección de la instancia
     * @param string $setter Nombre del método de inyección
     * @return ReflectionMethod|null Método de inyección
     */
    private function getDependenceInjector(ReflectionClass $reflection, string $setter): ?ReflectionMethod {
        if ($reflection->hasMethod($setter)) {
            $injector = $reflection->getMethod($setter); // Método

            return (!$injector->isPublic()) ? null : // No se puede acceder al método de inyección
                $injector; // Método de inyección de dependencia
        }

        return null; // Clase no contiene método para inyectar dependencia
    }
    
    /**
     * Permite obtener la instancia de la dependencia ha inyectar en la clase
     * en construcción, ya sea nueva o compartida 
     * 
     * @param Dependence $dependence Parámetro de dependencia
     * @param ContainerContext $context Contexto contenedor
     * @param string $classFactory Nombre de clase de factoría de dependencias
     * @param string $attrName Nombre de la clave
     * @return mixed Instancia de dependencia generada
     */
    private function createDependence(Dependence $dependence, ContainerContext $context, string $classFactory, string $attrName) {
        if ($dependence->isShared()) {
            $instance = $context->getSharedInstance($attrName); // Consultando
            
            if (is_null($instance)) {
                $instance = $context->create($classFactory, $dependence->getClass());
                $context->setSharedInstance($attrName, $instance);
            }
            
            return $instance; // Retornando instancia compartida
        } else {
            return $context->create($classFactory, $dependence->getClass()); // Nueva instancia
        }
    }

    /**
     * Permite construir una instancia de la clase establecida
     * 
     * @param string $class Nombre de clase ha instanciar
     * @return mixed
     */
    protected function build(string $class) {
        return new $class(); // Instanciando clase
    }

    /**
     * Retorna el nombre del método de inyección de la dependencia
     * 
     * @param string $attrName Nombre de atributo de la dependencia
     * @return string
     */
    protected function getMethodName(string $attrName): string {
        return "set".ucwords($attrName); // Nombre del Método
    }
}