<?php
/*
 * This file is part of the DocuSign package.
 *
 * (c) Unit6 <team@unit6websites.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unit6\DocuSign;

/**
 * Client class for sending and receiving DocuSign headers.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Client implements ClientInterface
{
    protected $credentials;
    protected $request;

    protected $version;
    protected $environment;
    protected $baseUrl;
    protected $accountId;

    // The flag indicating if it has multiple DocuSign accounts
    protected $hasMultipleAccounts = FALSE;

    protected $hasError = FALSE;
    protected $errorMessage = '';

    protected static $instance;

    public function __construct(array $config = array())
    {
        if ( ! ini_get('date.timezone')
            && function_exists('date_default_timezone_set')) {
            date_default_timezone_set('UTC');
        }

        if (empty($config)) {
            throw new Exception\Client('Configuration options required.');
        }

        if ( ! isset($config['version'])) {
            throw new Exception\Client('Specify the DocuSign API version to use.');
        }

        if ( ! isset($config['environment'])) {
            throw new Exception\Client('Specify the DocuSign API environment to use.');
        }

        $this->credentials = new Credentials($config);

        if ($this->credentials->isEmpty()) {
            throw new Exception\Authentication('DocuSign credentials are required.');
        }

        // The version of DocuSign API (Ex: v1, v2)
        $this->version = $config['version'];

        // The DocuSign Environment (Ex: demo, test, www)
        $this->environment = $config['environment'];

        // The DocuSign AccountId (Optional)
        if (isset($config['account_id'])) {
            // For multiple accounts user:
            //   - if it's empty, the default account will be used
            //   - otherwise, the DocuSign account with this account id will be used
            $this->accountId   = $config['account_id'];
        }

        $this->request = new Request();

        self::setInstance($this);
    }

    public static function setInstance(Client $client)
    {
        self::$instance = $client;
    }

    public static function getInstance()
    {
        return self::$instance;
    }

    public function authenticate()
    {
        $service = new Service\Authentication();

        try {
            $response = $service->getLoginInformation();

            if ( ! isset($response['loginAccounts'])) {
                throw new Exception\Client('DocuSign loginAccounts not found.');
            }

            $accounts = $response['loginAccounts'];

            // detect whether there are multiple accounts.
            $this->hasMultipleAccounts = (count($accounts) > 1);

            $defaultAccount = array();

            // determine which account should be used.
            foreach ($accounts as $account) {
                if ( ! empty($this->accountId)) {
                    if (isset($account['accountId'])
                        && $account['accountId'] === $this->accountId) {
                        $defaultAccount = $account;
                        break;
                    }
                }

                if (isset($account['isDefault'])
                    && $account['isDefault'] === 'true') {
                    $defaultAccount = $account;
                    break;
                }
            }

            if (isset($defaultAccount['baseUrl'], $defaultAccount['accountId'])) {
                $this->baseUrl = $defaultAccount['baseUrl'];
                $this->accountId = $defaultAccount['accountId'];
            }

        } catch (Exception\Request $e) {
            $response = NULL;

            $this->hasError = true;
            $this->errorMessage = $e->getMessage();
        }

        return $response;
    }

    public function getHeaders(
            $accept = 'Accept: application/json',
            $contentType = 'Content-Type: application/json'
        )
    {
        $authentication = '<DocuSignCredentials>'
            . '<Username>' . $this->credentials->getEmail() . '</Username>'
            . '<Password>' . $this->credentials->getPassword() . '</Password>'
            . '<IntegratorKey>' . $this->credentials->getIntegratorKey() . '</IntegratorKey>'
            . '</DocuSignCredentials>';

        return array(
            'X-DocuSign-Authentication: ' . $authentication,
            $accept,
            $contentType
        );
    }

    public function getCredentials()
    {
        return $this->credentials;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function getEnvironment()
    {
        return $this->environment;
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function getAccountId()
    {
        return $this->accountId;
    }

    public function hasMultipleAccounts()
    {
        return $this->hasMultipleAccounts;
    }

    public function hasError()
    {
        return $this->hasError;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function getEnvelopesOutForSignature()
    {
        $service = new Service\Envelopes();

        $criteria = array(
            'include_recipients' => 'true',
            'order_by' => Model\Envelope::ORDER_SENT,
            'order' => Model\Envelope::SORT_DESCENDING,
        );

        $folderName = Model\Envelope::SEARCH_FOLDER_OUT;

        $response = $service->getSearchInFolder($folderName, $criteria);

        return new Resource\Search($response);
    }

    public function deleteEnvelope($envelopeId, $reason)
    {
        $error = NULL;

        try {
            $service = new Service\Envelopes();
            $response = $service->voidEnvelope($envelopeId, $reason);
        } catch (Exception\Request $e) {
            $error = $e->getMessage();
        }

        return $error;
    }

    public function getEnvelope($envelopeId)
    {
        $service = new Service\Envelopes();
        $response = $service->getEnvelope($envelopeId);

        return new Resource\Envelope($response);
    }

    public function getEnvelopeSigningUrl($envelopeId, array $viewParams = array())
    {
        $url = NULL;

        $service = new Service\Views();

        $view = new Model\View($viewParams);

        $response = $service->createEnvelopeRecipientView($envelopeId, $view);

        if (isset($response['url'])) {
            $url = $response['url'];
        }

        return $url;
    }

    /**
     * Create and Send Envelope
     */
    public function sendSignatureRequest(Model\Envelope $envelope)
    {
        $service = new Service\Envelopes();

        $envelope->setStatus(Model\Envelope::STATUS_SENT);

        return $service->createEnvelope($envelope);
    }

    public static function getPreparedDocuments(array $files = array())
    {
        $documents = array(
            'errors' => array(),
            'list'   => array()
        );

        foreach ($files as $i => $file) {
            $path = $file['path'];
            $id = $i + 1;

            try {
                $document = new Model\Document();
                $document->fromFile($path, $id);

                $documents['list'][] = $document;

            } catch (Exception\Document $e) {
                $documents['errors'] = $e->getMessage();
            }
        }

        return $documents;
    }

    public static function getRequestEvents()
    {
        return Request::getEvents();
    }

    public static function document(array $params = array())
    {
        return new Model\Document($params);
    }

    public static function envelope(array $params = array())
    {
        return new Model\Envelope($params);
    }

    public static function recipient(array $params = array())
    {
        return new Model\Recipient($params);
    }

    public static function tab(array $params = array())
    {
        return new Model\Tab($params);
    }
}