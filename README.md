# YandexDirectClient

Пакет для работы с сервисом Яндекс.Direct посредством его API.

* Подготовлен к использованию через Composer
* Определен автолоадер (согласно psr-4)
* Доступны все методы API
* Дополнительно перед отправкой проводится валидация входных данных через json-schema (База наполняется)

1) Установка
----------------------------------

    Добавьте "bubnovKelnik/yandex-direct-client": "dev-master" в секцию require файла composer.json
    Добавьте 
    {
        "type": "vcs",
        "url":  "git@github.com:bubnovKelnik/yandex-direct-client.git"
    }
    в секцию repositories файла composer.json
    
    composer update

2) Использование
-------------------------------------
```php
<?php
require 'vendor/autoload.php';

$authKey = 'MY-AUTH-TOKEN';

$client = new YandexDirectClient\Client($authKey);

try {
    /**
     * Getting Units for users
     */
    $response = $client->GetClientsUnits(['my-user','customer-user']);
    
    /**
     * If Response is an array - you can access to each element as in array
     */
    foreach($response as $item){
        /**
         * If the item has a property (see Yandex Direct API docs) - you can access it by getter
         */
        echo "\n" . $item->getLogin() . " has units: " . $item->getUnitsRest();
    }
    
    /**
     * Archiving the company
     */
    $response = $client->ArchiveCampaign(['CampaignID' => 11]);
    
    /**
     * As in API docs, response is integer, so if you echo $response, you will get plain integer
     */
    echo "\nStatus = " . $response; //outputs "Status = 1"

    /**
     * And so on...
     */
}
catch (\YandexDirectClient\YandexErrorException $e){
    echo "\nYandexErrorException: " . $e->getMessage() . "\nWith details: " . $e->getErrorDetail() . "\n";
}
catch (\Exception $e){
    echo "\nException: " . $e->getMessage() . "\n";
}
```

3) TODO
-------------------------------------

Расширение json schema для методов