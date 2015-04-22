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
     * Provided param for method
     * @var Array 
     */
    protected $param = [];
    
    /**
     * 
     * @param Any or null $arguments
     */
    public function __construct($arguments = null) {
        if(is_array($arguments) && isset($arguments[0]) && is_array($arguments[0])){
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
     * Checks provided params before request
     * @throws \YandexDirectClient\ClientErrorException
     */
    abstract public function isValid();
    
    /**
     * Create response object
     * @throws \YandexDirectClient\YandexErrorException
     * @return \YandexDirectClient\Response or any
     */
    public function createResponse(array $data = array())
    {
        if(!is_array($data)){
            return $data;
        }
        if(Response::isAssoc($data)){
            $response = new Response($data);
        }
        else {
            $response = new Response();
            foreach($data as $item){
                $response[] = $this->createResponse($item);
            }
        }
        
        return $response;
    }
}