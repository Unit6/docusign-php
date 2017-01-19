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

    $envelope = Client::envelope(array(
        'emailSubject' => 'TEST: Tenancy Agreement for Property',
        'emailBlurb'   => 'This is only a TEST.',
    ));

    $counters = array(
        'recipients' => 0
    );

    foreach ($users as $i => $user) {
        $type = strtoupper($user['type']);
        $clientUserId = $user['id'];

        $counters['recipients'] += 1;

        $counters[$type] = 1 + (isset($counters[$type]) ? $counters[$type] : 0);

        $recipientId  = $counters['recipients'];
        $anchorString = sprintf('~%s%d', $type, $counters[$type]);

        $recipient = Client::recipient(array(
            'name'         => $user['name'],
            'email'        => $user['email'],
            'routingOrder' => $user['order'],
            'recipientId'  => $recipientId,
            'clientUserId' => $clientUserId,
        ));

        $recipient->setSignAtDocuSign();

        $tab = Client::tab(array(
            'anchorString'             => $anchorString,
            'anchorXOffset'            => '1',
            'anchorYOffset'            => '1',
            'anchorIgnoreIfNotPresent' => 'true',
            'documentId'               => 1,
            'recipientId'              => $recipientId
        ));

        $tab->setAnchorUnitsToPixels();

        $recipient->addTabSignHere($tab);

        $envelope->addRecipientSigner($recipient);
    };

    if ( ! $envelope->hasRecipientSigners()) {
        echo 'No valid recipient signers included.' . PHP_EOL;
        exit;
    };

    $documents = Client::getPreparedDocuments($files);

    if ( ! empty($documents['errors'])) {
        echo 'No valid documents included.' . PHP_EOL;
        var_dump($documents['errors']);
        exit;
    };

    $envelope->addDocuments($documents['list']);

    $outcome = $client->sendSignatureRequest($envelope);

    echo 'envelopeId' . "\t\t\t\t\t" . 'status' . "\t\t" . 'statusDateTime' . PHP_EOL;
    echo '----------' . "\t\t\t\t\t" . '------' . "\t\t" . '--------------' . PHP_EOL;
    echo $outcome['envelopeId'] . "\t\t" . $outcome['status'] . "\t\t" . $outcome['statusDateTime'] . PHP_EOL;

    #var_dump(Client::getRequestEvents());