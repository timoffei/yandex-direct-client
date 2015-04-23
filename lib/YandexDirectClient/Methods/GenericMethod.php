<?php
namespace YandexDirectClient\Methods;

/* 
 * GenericMethod
 * For all not implemented yet methods
 */
class GenericMethod extends AbstractMethod
{
    /**
     * {@inheritdoc}
     */
    protected $methodName;
    
    /**
     * {@inheritdoc}
     */
    public function isValid() {
        
    }
    
    /**
     * 
     * @param String $methodName
     */
    public function setMethodName($methodName) {
        $this->methodName = $methodName;
    }
}
