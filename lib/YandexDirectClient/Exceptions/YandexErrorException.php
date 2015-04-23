<?php

namespace YandexDirectClient\Exceptions;

/* 
 * Common Yandex Direct error
 */

class YandexErrorException extends \Exception 
{
    /**
     * error_detail
     * @var String 
     */
    protected $errorDetail = null;
    
    /**
     * 
     * @param String $errorDetail
     */
    public function setErrorDetail($errorDetail = null) {
        $this->errorDetail = $errorDetail;
    }
    
    /**
     * 
     * @return String
     */
    public function getErrorDetail() {
        return $this->errorDetail;
    }
}