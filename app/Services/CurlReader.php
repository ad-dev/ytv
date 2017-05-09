<?php
namespace App\Services;

use App\Contracts\FeedReader;
use \LibXMLError;

class CurlReader implements FeedReader
{

    private $curlHandle;

    private $errorCode;

    private $errorMsg;

    private $httpCode;
    
    private $feedJson;

    public function readRaw($url)
    {
    	$this->curlHandle = curl_init($url);
    	curl_setopt($this->curlHandle, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($this->curlHandle, CURLOPT_FOLLOWLOCATION, true);
    	curl_setopt($this->curlHandle, CURLOPT_HEADER, false);
    	curl_setopt($this->curlHandle, CURLOPT_TIMEOUT_MS, 2000);
    	$response = curl_exec($this->curlHandle);
    
    	$this->errorCode = curl_errno($this->curlHandle);
    	$this->errorMsg = curl_error($this->curlHandle);
    	$this->httpCode = curl_getinfo($this->curlHandle, CURLINFO_HTTP_CODE);
    
    	return $response;
    }
    
    public function readJson($url)
    {
    	$response = $this->readRaw($url);
    	
    	$this->feedJson = json_decode($response);
    	$this->errorCode = json_last_error();
    	$this->errorMsg = json_last_error_msg();
    	return $this->feedJson;
    }

    public function getHttpCode()
    {
        return $this->httpCode;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function getErrorMessage()
    {
        return $this->errorMsg;
    }
}