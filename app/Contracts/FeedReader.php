<?php
namespace App\Contracts;

interface FeedReader
{
    /**
     * Reads feed from url
     * @param unknown $url
     */
    function readJson($url);
    /**
     * Gets HTTP response code
     */
    function getHttpCode();
    /**
     * Gets CURL response error code
     */
    function getErrorCode();
    /**
     * Gets CURL response error message
     */
    function getErrorMessage();
    
}
