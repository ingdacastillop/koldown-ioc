<?php

namespace Koldown\InversionControl;

use Koldown\InversionControl\Contracts\IDependenceFactory;

class ContainerContext {
    
    // Atributos de la clase ApplicationContext
    
    /**
     * Instancia de la clase ApplicationContext
     * 
     * @var ContainerContext 
     */
    protected static $instance;
    
    /**
     * Clase constructor de objetos
     * 
     * @var ClassBuilder 
     */
    private $builder;

    /**
     * Nombre de clase de constructor de dependencia
     * 
     * @var string 
     */
    protected $classBuilder = ClassBuilder::class;

    /**
     * Factoría de dependencias del contexto
     * 
     * @var IDependenceFactory 
     */
    protected $dependenceFactory;
    
    /**
     * Almacén de factorías de dependencias
     * 
     * @var array 
     */
    private $factoriesDependences = [];
    
    /**
     * Almacén de dependencias compartidas
     * 
     * @var array 
     */
    private $sharedDependences = [];

    // Constructor de la clase ApplicationContext
    
    private function __construct() {
        
    }
    
    // Métodos de la clase ApplicationContext
    
    /**
     * Permite crear la instancia de una clase con sus dependencias
     * 
     * @param string $classFactory Factoría de dependencias
     * @param string $classInstance Clase ha construir
     * @return mixed Instancia de clase construida
     */
    public function create(string $classFactory, string $classInstance) {
        $builder = $this->getFactory($classFactory)->build($classInstance);
        
        if ($builder instanceof ClassInstance) {
            return $this->getBuilder()->create($builder, $this, $classFactory);
        } else {
            return $builder; // Retornando objeto generado
        }
    }
    
    /**
     * Permite establecer una dependencia compartida en el almacén del contexto
     * 
     * @param string $attrName Clave de la dependencia
     * @param mixed $dependence Instancia de la dependencia
     * @return void
     */
    public function setSharedInstance(string $attrName, $dependence): void {
        $this->sharedDependences[$attrName] = $dependence;
    }
    
    /**
     * Permite obtener una dependencia compartida del almacén del contexto
     * 
     * @param string $attrName Clave de la dependencia
     * @return mixed Instancia de la dependencia
     */
    public function getSharedInstance(string $attrName) {
        return (!isset($this->sharedDependences[$attrName])) ? null : $this->sharedDependences[$attrName];
    }

    /**
     * Permite solicitar la factoría de dependencia con la clase establecida
     * 
     * @param string $class Clase de la dependencia
     * @return IDependenceFactory Factoria de dependencia
     */
    private function getFactory(string $class): IDependenceFactory {
        $factory = $this->getDependenceFactory($class); // Factoría
        
        if (is_null($factory)) {
            $factory = new $class(); // Instanciando factoría de dependencias
            $this->setDependenceFactory($class, $factory);
        } // No existe instancia de la factoría 
        
        return $factory; // Retornando factoría de dependencias contexto
    }
    
    /**
     * Permite establecer una factoría de dependencias en el almacén del contexto
     * 
     * @param string $class Clave de la factoría
     * @param IDependenceFactory $factory Factoría de dependencias
     * @return void
     */
    private function setDependenceFactory(string $class, IDependenceFactory $factory): void {
        $this->factoriesDependences[$class] = $factory;
    }
    
    /**
     * Permite obtener una factoría de dependencias del almacén del contexto
     * 
     * @param string $class Clave de la factoría
     * @return IDependenceFactory|null Factoría de dependencias
     */
    private function getDependenceFactory(string $class): ?IDependenceFactory {
        return (!isset($this->factoriesDependences[$class])) ? null : $this->factoriesDependences[$class];
    }
    
    /**
     * Permite obtener el constructor de objetos con sus dependencias
     * 
     * @return ClassBuilder Constructor de objetos
     */
    private function getBuilder(): ClassBuilder {
        if (is_null($this->builder)) {
            $this->builder = new $this->classBuilder();
        }
        
        return $this->builder; // Constructor de clase
    }

    /**
     * Retorna la instancia de la clase ContainerContext
     * 
     * @return ContainerContext Patrón singleton
     */
    public static function getInstance(): ContainerContext {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        } // Instanciando clase ApplicationContext
        
        return self::$instance; // Retornando instancia
    }
}