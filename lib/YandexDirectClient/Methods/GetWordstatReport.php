<?php
namespace YandexDirectClient\Methods;

use YandexDirectClient\Exceptions\ClientErrorException;

/* 
 * GetWordstatReport method
 * @link https://tech.yandex.ru/direct/doc/dg-v4/reference/GetWordstatReport-docpage/
 */
class GetWordstatReport extends AbstractMethod
{
    /**
     * {@inheritdoc}
     */
    protected $methodName = "GetWordstatReport";
    
    protected static $schema = '{
        "$schema": "http://json-schema.org/draft-04/schema#",
        "id": "/",
        "type": "integer"
    }';

    /**
     * {@inheritdoc}
     */
    public function isValid() {
        $this->validateSchema();
    }
}
