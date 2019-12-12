<?php

namespace Koldown\InversionControl;

class ClassInstance {
    
    // Atributos de la clase ClassInstance
    
    /**
     * Nombre de clase de la instancia ha crear
     * 
     * @var string 
     */
    private $class;
    
    /**
     * Almacén de dependencias de la instancia ha crear
     * 
     * @var array 
     */
    private $dependences = [];
    
    // Constructor de la clase ClassInstance
    
    /**
     * Permite establecer el nombre de clase de la instancia ha crear
     * 
     * @param string $class Nombre de clase para crear instancia
     */
    public function __construct(string $class) {
        $this->setClass($class);
    }
    
    // Métodos de la clase ClassInstance
    
    /**
     * Permite establecer el nombre de clase de la instancia ha crear
     * 
     * @param string $class Nombre de clase para crear instancia
     * @return void
     */
    public function setClass(string $class): void {
        $this->class = $class;
    }
    
    /**
     * Retorna nombre de clase de la instancia a crear
     * 
     * @return string Nombre de clase para instanciar
     */
    public function getClass(): string {
        return $this->class;
    }

    /**
     * Retorna una instancia generada apartir del nombre de clase establecido
     * 
     * @return mixed Instancia generada por la clase
     */
    public function getInstance() {
        return new $this->class();
    }
    
    /**
     * Establece los parámetros para generar las dependencia de la instacia creada
     * 
     * @param string $key Nombre del atributo de la clase
     * @param string $class Nombre de clase de la dependencia
     * @param bool $shared Determina si la dependencia es compartida
     * @return ClassInstance Instancia de clase como interfaz fluida
     */
    public function setDependence(string $key, string $class, bool $shared = false): ClassInstance {
        $this->dependences[$key] = new Dependence($class, $shared); return $this;
    }
    
    /**
     * Retorna el almacén de dependencias de la instancia creada
     * 
     * @return array Almacén de dependencias
     */
    public function getDependences(): array {
        return $this->dependences;
    }
}