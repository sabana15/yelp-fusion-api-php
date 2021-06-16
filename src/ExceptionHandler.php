<?php 

namespace TrialAPI\Exception;

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
        return $this->responseBody;
    }

  /**
     * custom function to display the error as per requirement
     * @return string
     */
    public function errorMessage() {
        //error message
        $msg = json_decode($this->getResponseBody());
        echo 'Error: '.$msg->error->description;
      }
}
