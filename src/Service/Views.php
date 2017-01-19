<?php
/*
 * This file is part of the DocuSign package.
 *
 * (c) Unit6 <team@unit6websites.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unit6\DocuSign\Service;

use Unit6\DocuSign;
use Unit6\DocuSign\Model;
use Unit6\DocuSign\Exception;

/**
 * DocuSign Views Service Class.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Views extends DocuSign\Service
{
    /**
    * Constructs the internal representation of the DocuSign Views service.
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Post Authentication View
     *
     * This provides a URL to start the authentication view of the DocuSign UI.
     *
     * @param string $envelopeId Optional.
     */
    public function createAuthenticationView($envelopeId = '')
    {
        # POST /accounts/{accountId}/views/console
        # ?envelopeId=1

        $url = $this->getEndpoint('views/console');

        $json = null;

        if ( ! empty($envelopeId)) {
            $json = json_encode(array('envelopeId' => $envelopeId));
        }

        return $this->request->post($url, $this->client->getHeaders(), array(), $json);
    }

    /**
     * Post Envelope Correction
     *
     * This provides a URL to start the correction view of the DocuSign UI.
     *
     * @param string $envelopeId
     */
    public function createEnvelopeCorrectionView($envelopeId)
    {
        # POST /accounts/{accountId}/envelopes/{envelopeId}/views/correct
    }

    /**
     * Post Recipient View
     *
     * This provides a URL to start the recipient view of the DocuSign UI
     * or a sent envelope. This call cannot be used to view draft
     * envelopes, since those envelopes have not been sent.
     *
     * Important: DocuSign recommends that you do not use iFrames for
     * embedded operations on mobile devices.
     *
     * An entry is added into the Security Level section of the DocuSign
     * Certificate of Completion that reflects the "securityDomain"
     * – "authenticationMethod" used to verify the user identity.
     *
     * @param string $envelopeId
     * @param array  $params     Parameters contains:
     *                              - clientUserId:
     *                              - authenticationMethod:
     *                              - assertionId:
     *                              - authenticationInstant:
     *                              - securityDomain:
     *                              - email:
     *                              - recipientId:
     *                              - returnUrl:
     *                              - userId:
     *                              - userName:
     */
    public function createEnvelopeRecipientView($envelopeId, Model\View $view)
    {
        # POST /accounts/{accountId}/envelopes/{envelopeId}/views/recipient

        $url = $this->getEndpoint('envelopes/' . $envelopeId . '/views/recipient');

        $view->setAuthenticationMethodToEmail();

        $json = json_encode($view->getData());

        return $this->request->post($url, $this->client->getHeaders(), array(), $json);
    }

    /**
     * Post Sender View
     *
     * This provides a URL to start the sending view of the DocuSign UI.
     * This is a one-time use login token that allows the user to be
     * placed into the DocuSign sending view. Upon sending completion,
     * the user is returned to the return URL provided by the API application.
     *
     * Important: DocuSign recommends that you do not use iFrames for embedded
     * operations on mobile devices.
     *
     * @param string $envelopeId
     * @param string $returnUrl  Identifies the return point after sending
     *                           the envelope.
     */
    public function createEnvelopeSenderView($envelopeId, $returnUrl)
    {
        # POST /accounts/{accountId}/envelopes/{envelopeId}/views/sender

        $url = $this->getEndpoint('envelopes/' . $envelopeId . '/views/sender');

        $view = new Model\View(array(
            'returnUrl' => $returnUrl
        ));

        $json = json_encode($view->getData());

        return $this->request->post($url, $this->client->getHeaders(), array(), $json);
    }
}