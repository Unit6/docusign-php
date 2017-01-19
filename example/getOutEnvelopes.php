<?php
/**
 * DocuSign - getOutEnvelopes
 *
 * @package    DocuSign
 * @author     Unit6 <team@unit6websites.com>
 */

    require realpath(dirname(__FILE__) . '/../autoload.php');
    require realpath(dirname(__FILE__) . '/../tests/Bootstrap.php');

    use Unit6\DocuSign\Client;

    $client = new Client($config);

    $client->authenticate();

    if ($client->hasError()) {
        echo $client->getErrorMessage() . PHP_EOL;
        exit;
    };

    $search = $client->getEnvelopesOutForSignature();

    $folderItems = $search->getFolderItems();

    if (empty($folderItems)) {
        echo 'No folderItems found in response.' . PHP_EOL;
        exit;
    };

    echo 'envelopeId' . "\t\t\t\t" . 'sentDateTime' . "\t\t\t" . 'status' . PHP_EOL;
    echo '----------' . "\t\t\t\t" . '------------' . "\t\t\t" . '------' . PHP_EOL;
    foreach ($folderItems as $folderItem) {
        echo $folderItem->getEnvelopeId()
            . "\t" . $folderItem->getSentDateTime()
            . "\t" . $folderItem->getStatus() . PHP_EOL;
    };

    #var_dump(Client::getRequestEvents());
