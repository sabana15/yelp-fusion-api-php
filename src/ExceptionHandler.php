<?php 

namespace TrialAPI;

class ExceptionHandler extends \Exception
{
    protected $responseBody;

    /**
     * Set exception response body from Http request
     * @param string $body
     */
    public function setResponseBody($body = null)
    {
        $this->responseBody = $body;
        return $this;
    }

    /**
     * Get exception response body
     * @return string
     */
    public function getResponseBody()
    {
        $responseBody = json_decode($this->responseBody, true);
        return 'Validation Error : '.$responseBody['error']['description'];
    }
}
