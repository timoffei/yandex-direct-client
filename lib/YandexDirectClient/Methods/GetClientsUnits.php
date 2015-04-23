<?php
namespace YandexDirectClient\Methods;

use YandexDirectClient\Exceptions\ClientErrorException;

/* 
 * GetClientsUnits method
 * @link https://tech.yandex.ru/direct/doc/dg-v4/reference/GetClientsUnits-docpage/
 */
class GetClientsUnits extends AbstractMethod
{
    /**
     * {@inheritdoc}
     */
    protected $methodName = "GetClientsUnits";
    
    /**
     * {@inheritdoc}
     */
    public function isValid() {
        if(!is_array($this->param) || empty($this->param)){
            throw new ClientErrorException('GetClientsUnits expects param to be not empty array', 500);
        }
    }
}
