<?php
namespace YandexDirectClient\Methods;

use YandexDirectClient\Exceptions\ClientErrorException;

/* 
 * ArchiveCampaign method
 * @link https://tech.yandex.ru/direct/doc/dg-v4/reference/ArchiveCampaign-docpage/
 */
class ArchiveCampaign extends AbstractMethod
{
    /**
     * {@inheritdoc}
     */
    protected $methodName = "ArchiveCampaign";
    
    protected static $schema = '{
        "$schema": "http://json-schema.org/draft-04/schema#",
        "id": "/",
        "type": "object",
        "additionalProperties":false,
        "properties": {
          "CampaignID": {
            "id": "CampaignID",
            "type": "integer"
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
