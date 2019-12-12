<?php

namespace Koldown\InversionControl;

class Dependence {
    
    // Atributos de la clase Dependence
    
    /**
     * Nombre de clase de la dependencia
     * 
     * @var string 
     */
    private $class;
    
    /**
     * Determina si la dependencia es compartida 
     * 
     * @var bool 
     */
    private $shared;
    
    // Constructor de la clase Dependence
    
    /**
     * Permite definir el nombre de clase de la dependencia y determinar
     * si esta será compartida al momento de realizar la inyección
     * 
     * @param string $class Nombre de clase de la dependencia
     * @param bool $shared Determina si la dependencia es compartida
     */
    public function __construct(string $class, bool $shared = false) {
        $this->setClass($class); $this->setShared($shared);
    }
    
    // Métodos de la clase Dependence
    
    /**
     * Permite establecer el nombre de clase de la dependencia
     * 
     * @param string $class Nombre de clase
     * @return void
     */
    public function setClass(string $class): void {
        $this->class = $class;
    }
    
    /**
     * Retorna el nombre de clase de la dependencia
     * 
     * @return string Nombre de clase de la dependencia
     */
    public function getClass(): string {
        return $this->class;
    }
    
    /**
     * Permite determinar si la dependencia será compartida
     * 
     * @param bool $shared Determina si la dependencia es compartida
     * @return void
     */
    public function setShared(bool $shared): void {
        $this->shared = $shared;
    }
    
    /**
     * Permite verificar si la dependencia es compartida
     * 
     * @return bool Verificación si es compartida
     */
    public function isShared(): bool {
        return $this->shared;
    }
}