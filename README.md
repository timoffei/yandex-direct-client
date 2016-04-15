# YandexDirectClient
Требует curl-расширение!

Пакет для работы с сервисом Яндекс.Direct посредством его API.

* Подготовлен к использованию через Composer
* Определен автолоадер (согласно psr-4)
* Доступны все методы API
* Дополнительно перед отправкой проводится валидация входных данных через json-schema (База наполняется)

1) Установка *Composer*
----------------------------------
    {
        "require": {"bubnovKelnik/yandex-direct-client": "1.0.0"},
        "repositories": [
            {
                "type": "vcs",
                "url":  "git@github.com:bubnovKelnik/yandex-direct-client.git"
            }
        ]
    }
    
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
     * Or you can access directly Nth element in array
     */
    echo "\nFirst user units: " . $response->get(0)->getUnitsRest();
    
    /**
     * Generating WordstatReport
     */
    $reportId = $client->CreateNewWordstatReport(['Phrases' => ['Купить холодильник', 'Холодильники недорого']]);
    echo "\nReportId: " . $reportId;
    
    /**
     * Wait for 10 seconds
     */
    sleep(10);
    
    /**
     * Getting full reports list
     */
    $reports = $client->GetWordstatReportList();
    foreach($reports as $report){
        /**
         * Find report with $reportId and status 'Done'
         */
        if($report->getReportID() == $reportId && $report->getStatusReport() === 'Done'){
            echo "\nReport is done, reading";
            break;
        }
    }
    
    /**
     * Get wordstat report by $reportId
     */
    $report = $client->GetWordstatReport($reportId);
    foreach($report as $reportPart){
        foreach($reportPart->getSearchedWith() as $searchedWith){
            echo sprintf(
                "\nPhrase `%s` has %d shows \n", 
                $searchedWith->getPhrase(), 
                $searchedWith->getShows()
            );
        }
    }
    
    /**
     * Deleting wordstat report
     */
    $status = $client->DeleteWordstatReport($reportId);
    echo $status ? "\nReport successfully deleted" : "\nSomething wrong...";
}
catch (\YandexDirectClient\Exceptions\YandexErrorException $e){
    echo "\nYandexErrorException: " . $e->getMessage() . "\nWith details: " . $e->getErrorDetail() . "\n";
}
catch (\Exception $e){
    echo "\nException: " . $e->getMessage() . "\n";
}
```

3) TODO
-------------------------------------

Расширение json schema для методов
