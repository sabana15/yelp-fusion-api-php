<?php
namespace TrialAPI;

use \Exception;
use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;
use TrialAPI\HttpTrait;

class YelpClient
{
    use HttpTrait;
    protected $apiKey, $httpClient;

    public function __construct($apiKey= '')
    {
        try{
        // Set the API Key
        $this->apiKey = $apiKey;
        }
        catch(Exception $e)
        {
            $exception = new Exception($e->getMessage());
            throw $exception->setResponseBody((string) $e->getResponse()->getBody());
        }
        /**
         * Get the HTTP Client if exist
         *  Create/Set the HTTP CLient if not exist
         */

        if (!$this->getHttpClient()) {
            $httpClient = $this->createtHttpClient();
            $this->setHttpClient($httpClient);
        }

    }

    /**
     *  Create new http CLient
     *  @return \GuzzleHttp\Client
     */
    public function createtHttpClient()
    {
        return new HttpClient([
            'headers' => $this->setDefaultHeaders()
        ]);
    }

    /**
     * Set the authorization header
     * @return array 
     */ 
    protected function setDefaultHeaders()
    {
        return [
            'Authorization' => 'Bearer ' . $this->getApiKey(),
        ];
    }

    /**
     *  return the value of API Key
     *  @return string|null
     */
    private function getApiKey()
    {
        return $this->apiKey;
    }

  /**
     * Search for the businesses
     * @param    array     $parameters
     * @return   stdClass
     */
    public function getBusinessesSearchResults($parameters = [])
    {
        $arrayParams = ['attributes', 'categories', 'price'];

        $path = $this->appendUrlwithParams('/v3/businesses/search', $parameters, $arrayParams);
        
        $request = $this->getClientRequest('GET', $path, $this->setDefaultHeaders());
      
        return $this->processClientRequest($request);
    }
}
?>