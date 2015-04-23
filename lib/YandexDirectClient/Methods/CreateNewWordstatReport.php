<?php
namespace YandexDirectClient\Methods;

use YandexDirectClient\Exceptions\ClientErrorException;

/* 
 * CreateNewWordstatReport method
 * @link https://tech.yandex.ru/direct/doc/dg-v4/reference/CreateNewWordstatReport-docpage/
 */
class CreateNewWordstatReport extends AbstractMethod
{
    /**
     * {@inheritdoc}
     */
    protected $methodName = "CreateNewWordstatReport";
    
    protected static $schema = '{
        "$schema": "http://json-schema.org/draft-04/schema#",
        "id": "/",
        "type": "object",
        "additionalProperties":false,
        "properties": {
          "Phrases": {
            "id": "Phrases",
            "type": "array",
            "uniqueItems": true,
            "additionalItems": true,
            "minItems": 1,
            "items": {
              "id": "0",
              "type": "string"
            }
          },
          "GeoID": {
            "id": "GeoID",
            "type": "array",
            "minItems": 1,
            "uniqueItems": true,
            "additionalItems": true,
            "items": {
              "id": "0",
              "type": "integer"
            }
          }
        }
    }';

    /**
     * {@inheritdoc}
     */
    public function isValid() {
        $this->validateSchema();
    }
}
