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
    
    protected static $schema = '{
        "$schema": "http://json-schema.org/draft-04/schema#",
        "id": "/",
        "type": "array",
        "minItems": 1,
        "uniqueItems": true,
        "additionalItems": true,
        "items": {
            "id": "0",
            "type": "string"
        }
    }';
    
    /**
     * {@inheritdoc}
     */
    public function isValid() {
        $this->validateSchema();
    }
}
