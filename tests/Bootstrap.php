<?php
/**
 * DocuSign
 *
 * @package    DocuSign
 * @author     Unit6 <team@unit6websites.com>
 */

#require 'vendor/autoload.php';

$config = array(
    'integrator_key' => getenv('DOCUSIGN_INTEGRATOR_KEY'),
    'email'          => getenv('DOCUSIGN_EMAIL'),
    'password'       => getenv('DOCUSIGN_PASSWORD'),
    'account_id'     => getenv('DOCUSIGN_ACCOUNT_ID'),
    'version'        => '2',
    'environment'    => 'demo'
);

$users = array(
    array(
        'id'    => '10001',
        'name'  => 'John Smith',
        'email' => 'j.smith@example.org',
        'type'  => 'landlord',
        'order' => '1',
    ),
    array(
        'id'    => '10002',
        'name'  => 'Jane Doe',
        'email' => 'j.doe@example.org',
        'type'  => 'tenant',
        'order' => '2',
    ),
    array(
        'id'    => '10004',
        'name'  => 'Joe Bloggs',
        'email' => 'j.bloggs@example.org',
        'type'  => 'tenant',
        'order' => '2',
    ),
);

$documentPath = realpath(dirname(__FILE__) . '/files/document.rtf');

$files = array(
    array(
        'name' => 'Test Document',
        'path' => $documentPath
    ),
);
