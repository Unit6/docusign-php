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

use GuzzleHttp;

/**
 * Request class for handling DocuSign requests.
 *
 * @author Unit6 <team@unit6websites.com>
 */
class Request #implements RequestInterface
{
    private static $methods = ['get', 'post', 'put', 'delete'];
    private static $events = [];
    private static $eventsNum = 0;

    public function __construct()
    {
        //
    }

    public static function __callStatic($name, $arguments)
    {
        if (in_array($name, self::$methods)) {
            $method = strtoupper($name);
            $uri = array_shift($arguments);
            $options = array_shift($arguments);
            return self::execute($method, $uri, $options);
        }

        throw new Exception\Model('Undefined method in Request class.');
    }

    /**
     * Execute a DocuSign cURL Request.
     */
    public static function execute($method = 'GET', $uri, array $options = array())
    {
        $client = Client::getInstance();
        $url = $client->getEndpoint($uri === '/' ? '' : $uri);

        /*
        $defaultHeaders = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $options['headers'] = array_merge($defaultHeaders, $options['headers']);
        */

        self::eventInitiate($method, $url, $options);

        /*
        $handler = GuzzleHttp\HandlerStack::create();

        $middleware = GuzzleHttp\Middleware::mapResponse(function (GuzzleHttp\Psr7\Response $response) {
            $body = $response->getBody();
            $contents = $body->getContents();
            $response->json = json_decode($contents, $assoc = true);
            return $response->withHeader('X-Foo', 'bar');
        });

        $handler->push($middleware, 'json_decode');

        $http = new GuzzleHttp\Client([
            'handler'  => $handler,
            'timeout'  => 5.0
        ]);
        */

        $http = new GuzzleHttp\Client([
           # 'debug' => true,
            'timeout'  => 5.0
        ]);

        $request = new GuzzleHttp\Psr7\Request($method, $url);

        try {
            $response = $http->send($request, $options);
        } catch (GuzzleHttp\Exception\RequestException $e) {
            self::eventUpdate($e->getMessage());
            if ($e->hasResponse()) {
                $response = $e->getResponse();
            } else {
                throw new Exception\Request($e->getMessage());
            }
        }

        self::eventUpdate($response->getStatusCode());

        $body = $response->getBody();
        $contents = $body->getContents();

        $json = [];
        $jsonError = 0;

        if ($response->hasHeader('Content-Type')
            && strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
            $json = json_decode($contents, $assoc = true);
            $jsonError = json_last_error();
        }

        if (isset($json['errorCode'], $json['message'])) {
            $errorMessage = $json['errorCode'] . ': ' . $json['message'];
            self::eventUpdate($errorMessage);
            throw new Exception\Request($errorMessage);
        }

        $headers = array();

        foreach ($response->getHeaders() as $key => $value) {
            $headers[$key] = $response->getHeaderLine($key);
        }

        $response = [
            'status' => $response->getReasonPhrase(), // OK
            'statusCode' => $response->getStatusCode(), // 200,
            'headers' => $headers,
            'contents' => $contents,
            'json'=> $json,
            'jsonError'=> $jsonError,
        ];

        return $response;
    }

    public static function eventInitiate($method, $url, array $options = array())
    {
        self::$eventsNum += 1;

        $i = self::$eventsNum - 1;

        self::$events[$i] = array(
            'method'  => $method,
            'url'     => $url,
            'options' => $options,
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
}