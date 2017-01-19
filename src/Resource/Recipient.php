<?php
/*
 * This file is part of the DocuSign package.
 *
 * (c) Unit6 <team@unit6websites.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unit6\DocuSign\Resource;

use Unit6\DocuSign;
use Unit6\DocuSign\Model;
use Unit6\DocuSign\Service;

/**
 * DocuSign Recipient Resource Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Recipient extends DocuSign\Resource
{
    protected $idField = 'recipientIdGuid';

    public function __construct(array $response = array())
    {
        parent::__construct($response);
    }

    public function __call($name, $arguments)
    {
        $pattern = '/(isEnvelope)([A-Z]{1}[\S]+)/';
        $found = preg_match($pattern, $name, $matches);

        if ($found) {
            list($name, $prefix, $key) = $matches;

            $key = lcfirst($key);
            $key = preg_replace('/([a-z])([A-Z])/', '$1_$2', $key);
            $key = strtoupper( $key );

            $classPath = explode('\\', __NAMESPACE__);
            array_pop($classPath);
            $strConstant = implode('\\', $classPath) . '\\Model\\Envelope::STATUS_' . $key;

            $status = @constant($strConstant);

            if ( ! is_null($status)) {
                return ($this->getStatus() === $status);
            }
        }

        return parent::__call($name, $arguments);
    }

    public function isNextToSign($currentRoutingOrder)
    {
        return ($currentRoutingOrder === $this->getRoutingOrder());
    }

    public function getEnvelopeView($returnUrl)
    {
        $url = null;

        // NOTE: You can only retrieve a URL when the receipients
        //       envelope status is sent or delivered. The routingOrder will
        //       prevent you from breaking the sequence.
        if ($this->isEnvelopeSent() || $this->isEnvelopeDelivered()) {
            $service = new Service\Views();

            $view = new Model\View(array(
                'returnUrl'    => $returnUrl,
                'email'        => $this->getEmail(),
                'userName'     => $this->getName(),
                'clientUserId' => $this->getClientUserId(),
            ));

            $response = $service->createEnvelopeRecipientView($this->getEnvelopeId(), $view);

            if (isset($response['url'])) {
                $url = $response['url'];
            }
        }

        return $url;
    }
}