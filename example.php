<?php

/* 
 * Example of usage yandex-direct-client lib.
 * @author Bubnov Mihail <bubnov.mihail@gmail.com>.
 */

/*
 * Use composer autoloader
 */
require 'vendor/autoload.php';

$authKey = 'YOUR-AUTH-KEY';

$client = new YandexDirectClient\Client($authKey);

try {
    /**
     * Getting Units for users
     */
    $response = $client->GetClientsUnits(['login-to-check']);
    foreach($response as $item){
        echo "\n" . $item->getLogin() . " has units: " . $item->getUnitsRest();
    }
    
    
}
catch (\YandexDirectClient\YandexErrorException $e){
    echo "\nGot error: " . $e->getMessage() . "\nWith details: " . $e->getErrorDetail() . "\n";
}
catch (\Exception $e){
    echo "\nGot error: " . $e->getMessage() . "\n";
}
echo "\n";