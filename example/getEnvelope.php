<?php
/**
 * DocuSign - getEnvelope
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

    $envelopeId = '00000000-0000-0000-0000-000000000000';
    $returnUrl = 'http://www.docusign.dev/';

    $envelope = $client->getEnvelope($envelopeId);

    $recipients = $envelope->getRecipients();

    if ( ! isset(
        $recipients['signers'],
        $recipients['recipientCount'],
        $recipients['currentRoutingOrder'])) {
        echo 'No $recipients found in response.' . PHP_EOL;
        exit;
    };

    $signers = $recipients['signers'];
    $currentRoutingOrder = $recipients['currentRoutingOrder'];

    echo 'recipientIdGuid' . "\t\t\t\t" . 'routingOrder' . "\t" . 'status' . "\t\t" . 'URL' . PHP_EOL;
    echo '---------------' . "\t\t\t\t" . '------------' . "\t" . '------' . "\t\t" . '---' . PHP_EOL;
    foreach ($signers as $recipient) {
        echo $recipient->getId()
            . "\t" . $recipient->getRoutingOrder()
            . "\t\t" . $recipient->getStatus();

        // only print the view URL for the next signer.
        if (($recipient->isEnvelopeSent() || $recipient->isEnvelopeDelivered()) &&
            $recipient->isNextToSign($currentRoutingOrder)) {
            echo "\t" . $url = $recipient->getEnvelopeView($returnUrl);
        }

        echo PHP_EOL;
    };

    #var_dump(Client::getRequestEvents());
