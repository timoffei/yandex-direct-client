<?php

/* 
 * Example of usage yandex-direct-client lib.
 * @author Bubnov Mihail <bubnov.mihail@gmail.com>.
 */

/*
 * Use composer autoloader
 */
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
    echo "\nGot YandexErrorException: " . $e->getMessage() . ", code: " . $e->getCode() . "\nWith details: " . $e->getErrorDetail() . "\n";
}
catch (\Exception $e){
    echo "\nGot Exception: " . $e->getMessage() . "\n";
}
echo "\n";