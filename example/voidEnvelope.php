<?php
/**
 * DocuSign - sendEnvelope
 *
 * @package    DocuSign
 * @author     Unit6 <team@unit6websites.com>
 */

    require realpath(dirname(__FILE__) . '/../autoload.php');
    require realpath(dirname(__FILE__) . '/../tests/Bootstrap.php');

    use Unit6\DocuSign\Client;

    $options = getopt('i:r:', array(
        'id:',
        'reason:',
    ));

    $envelopeId = (isset($options['i']) ? $options['i'] : (isset($options['id']) ? $options['id'] : NULL));
    $voidReason = (isset($options['r']) ? $options['r'] : (isset($options['reason']) ? $options['reason'] : NULL));

    if ( ! is_readable($documentPath)) {
        echo 'Document not found. $documentPath incorrect.' . PHP_EOL;
        exit;
    };

    $client = new Client($config);

    $client->authenticate();

    if ($client->hasError()) {
        echo $client->getErrorMessage() . PHP_EOL;
        exit;
    };

    echo 'Envelope to void: ' . PHP_EOL;
    echo "\t" . 'envelopeId: ' . $envelopeId . PHP_EOL;
    echo "\t" . 'voidReason: ' . $voidReason .  PHP_EOL;
    echo PHP_EOL;

    $outcome = $client->deleteEnvelope($envelopeId, $voidReason);

    echo 'Outcome' . "\t" . 'Message' . PHP_EOL;
    echo '-------' . "\t" . '-------' . PHP_EOL;
    echo (is_null($outcome) ? 'OK' : 'ERROR' . "\t" . $outcome) . PHP_EOL;

    #var_dump(Client::getRequestEvents());