<?php
namespace YandexDirectClient\Methods;

use YandexDirectClient\Response;

/**
 * Abstract method.
 * 
 * @author Bubnov Mihail <bubnov.mihail@gmail.com>.
 */
abstract class AbstractMethod 
{
    /**
     *
     * @var String 
     */
    protected $methodName;
    
    /**
     * Json schema to validate
     * @var String 
     */
    protected static $schema;
    
    /**
     * Provided param for method
     * @var Array 
     */
    protected $param = [];
    
    /**
     * 
     * @param Any or null $arguments
     */
    public function __construct($arguments = null) {
        if(is_array($arguments) && isset($arguments[0])){
            $this->param = $arguments[0];
        }
    }
    
    /**
     * 
     * @return Array or null
     */
    public function getParam() {
        return $this->param;
    }
    
    /**
     * 
     * @return String
     * @throws \YandexDirectClient\Exceptions\ClientErrorException
     */
    public function getMethodName() {
        if(empty($this->methodName)){
            throw new \YandexDirectClient\Exceptions\ClientErrorException('No methodName', 500);
        }
        
        return $this->methodName;
    }
    
    /**
     * Checks provided params before request
     * @throws \YandexDirectClient\Exceptions\ClientErrorException
     */
    abstract public function isValid();
    
    /**
     * Create response object
     * @param Any $data
     * @throws \YandexDirectClient\Exceptions\YandexErrorException
     * @return \YandexDirectClient\Response or any
     */
    public function createResponse($data = array())
    {
        if(!is_array($data)){
            return $data;
        }
        if(Response::isAssoc($data)){
            $newData = [];
            foreach($data as $key => $val){
                $newData[$key] = $this->createResponse($val);
            }
            $response = new Response($newData);
        }
        else {
            $response = new Response();
            foreach($data as $item){
                $response[] = $this->createResponse($item);
            }
        }
        
        return $response;
    }
    
    /**
     * Checks provided params by schema
     * @throws \YandexDirectClient\Exceptions\ClientErrorException
     */
    protected function validateSchema() {
        if(!static::$schema){
            return;
        }
        $validator = new \JsonSchema\Validator();
        $validator->check(json_decode(json_encode($this->param)), json_decode(static::$schema));

        if (!$validator->isValid()) {
            $errorTxt = "JSON does not validate. Violations:\n";
            foreach ($validator->getErrors() as $error) {
                $errorTxt.= sprintf("[%s] %s\n", $error['property'], $error['message']);
            }
            
            throw new \YandexDirectClient\Exceptions\ClientErrorException($errorTxt, 500);
        }
    }
}