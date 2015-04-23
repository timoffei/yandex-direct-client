<?php
namespace YandexDirectClient\Methods;

use YandexDirectClient\Exceptions\ClientErrorException;

/* 
 * GetWordstatReportList method
 * @link https://tech.yandex.ru/direct/doc/dg-v4/reference/GetWordstatReportList-docpage/
 */
class GetWordstatReportList extends AbstractMethod
{
    /**
     * {@inheritdoc}
     */
    protected $methodName = "GetWordstatReportList";
    
    protected static $schema = '';

    /**
     * {@inheritdoc}
     */
    public function isValid() {
        $this->validateSchema();
    }
}
