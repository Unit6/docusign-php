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
 * Request class for handling DocuSign requests.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Request implements RequestInterface
{
    const METHOD_GET  = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT  = 'PUT';
    const METHOD_DELETE = 'DELETE';

    protected static $events = array();
    protected static $eventsNum = 0;

    public function __construct()
    {
        //
    }

    public static function eventInitiate($method, $url, array $headers = array(), $payload)
    {
        self::$eventsNum += 1;

        $i = self::$eventsNum - 1;

        self::$events[$i] = array(
            'method'  => $method,
            'url'     => $url,
            'headers' => $headers,
            'payload' => $payload,
            'status'  => 'initiated',
        );
    }

    public static function eventUpdate($str)
    {
        $i = self::$eventsNum - 1;

        self::$events[$i]['status'] = $str;
    }

    public static function getEvents()
    {
        return self::$events;
    }

    /**
     * Execute a DocuSign cURL Request.
     */
    public function execute(
            $method = 'GET',
            $url,
            array $headers = array(),
            array $params = array(),
            $data = null
        )
    {
        $response;

        $method = strtoupper($method);

        $customRequests = array(
            self::METHOD_POST,
            self::METHOD_PUT,
            self::METHOD_DELETE
        );

        if ( ! empty($params)) {
            $url .= '?' . http_build_query($params, null, '&');
        }

        self::eventInitiate($method, $url, $headers, $data);

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        if (in_array($method, $customRequests)) {
            if ($method === self::METHOD_POST) {
                curl_setopt($ch, CURLOPT_POST, true);
            } else {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            }

            if ( ! empty($data)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
        }

        try {
            $result = curl_exec($ch);

            $error = curl_error($ch);

            if ( ! empty($error)) {
                self::eventUpdate($error);
                throw new Exception\Request($error);
            }

            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            self::eventUpdate($status_code);

            $jsonResult = json_decode($result, $assoc = true);
            $response = ( ! is_null($jsonResult) ? $jsonResult : $result);
        } catch (Exception $e) {

            self::eventUpdate($e->getMessage());

            throw new Exception\Request($e);
        }

        curl_close($ch);

        if (is_array($response) && isset($response['errorCode'])) {
            $error = $response['errorCode'] . ': ' . $response['message'];

            self::eventUpdate($error);

            throw new Exception\Request($error);
        }

        return $response;
    }

    public function get($url, array $headers = array(), array $params = array())
    {
        return $this->execute(self::METHOD_GET, $url, $headers, $params);
    }

    public function post($url, array $headers = array(), array $params = array(), $data = null)
    {
        return $this->execute(self::METHOD_POST, $url, $headers, $params, $data);
    }

    public function put($url, array $headers = array(), array $params = array(), $data = null)
    {
        return $this->execute(self::METHOD_PUT, $url, $headers, $params, $data);
    }

    public function delete($url, array $headers = array(), array $params = array(), $data = null)
    {
        return $this->execute(self::METHOD_DELETE, $url, $headers, $params, $data);
    }
}