<?php
namespace YandexDirectClient\Methods;

use YandexDirectClient\Exceptions\ClientErrorException;

/* 
 * DeleteWordstatReport method
 * @link https://tech.yandex.ru/direct/doc/dg-v4/reference/DeleteWordstatReport-docpage/
 */
class DeleteWordstatReport extends AbstractMethod
{
    /**
     * {@inheritdoc}
     */
    protected $methodName = "DeleteWordstatReport";
    
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
