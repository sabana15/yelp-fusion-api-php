<?php

namespace TrialAPI\Traits;

use \Exception;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use TrialAPI\Exception\ExceptionHandler;
    
trait HttpTrait
{
    
    protected $apiHost;
    protected $httpClient;
    protected $scheme;

   
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    public function setHttpClient(HttpClient $client)
    {
        $this->httpClient = $client;
        return $this;
    }

    protected function appendUrlwithParams($url, array $parameters = array(), array $options = array())
    {
        $url = rtrim($url, '?');
        $queryString = $this->prepareQueryParams($parameters, $options);

        if ($queryString) {
            $uri = new Uri($url);
            $existingQuery = $uri->getQuery();
            $updatedQuery = empty($existingQuery) ? $queryString : $existingQuery . '&' . $queryString;
            $url = (string) $uri->withQuery($updatedQuery);
        }

        return $url;
    }

    protected function prepareQueryParams($params = [], $arrayParams = [])
    {
        array_walk($params, function ($value, $key) use (&$params, $arrayParams) {
            if (is_bool($value)) {
                $params[$key] = (bool) $value ? 'true' : 'false';
            }

            if (in_array($key, $arrayParams)) {
                if (is_array($value)) {
                    $input = implode(',', $value);
                }
                $params[$key] = $input;
            }
        });

        return http_build_query($params);
    }

    public function getClientRequest($method, $uri, array $headers = [], $body = null, $version = '1.1')
    {
        $uri = new Uri($uri);

        if (!$uri->getHost()) {
            $uri = $uri->withHost("api.yelp.com");
        }
        
        if (!$uri->getScheme()) {
            $uri = $uri->withScheme(($this->scheme ?: 'https'));
        }
       
        return new Request($method, $uri, $headers, $body, $version);
    }

    protected function processClientRequest(RequestInterface $request)
    {
        $response = $this->getClientResponse($request);
        return json_decode($response->getBody());
    }

    public function getClientResponse(RequestInterface $request)
    {
        try {
            return $this->getHttpClient()->send($request);
        } catch (BadResponseException $e) {
            $exception = new ExceptionHandler($e->getMessage());
            $exception->setResponseBody((string) $e->getResponse()->getBody());
            $exception->errorMessage();
            
        }
    }

}