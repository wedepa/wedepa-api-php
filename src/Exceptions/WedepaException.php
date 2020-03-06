<?php


namespace Wedepa\Api\Exceptions;


use GuzzleHttp\Exception\GuzzleException;
use Throwable;

class WedepaException extends \Exception
{
    /**
     * @var string
     */
    private $wedepaCode = '';

    /**
     * @var array
     */
    private $errors = [];

    public function __construct($message = "", $code = "", $errors = [])
    {
        parent::__construct($message, 0, null);

        $this->wedepaCode = $code;
        $this->errors = $errors;
    }

    public static function createFromGuzzleException(GuzzleException $ex)
    {
        return new static('Wedepa API error', 'API', [$ex->getMessage()]);
    }

    public static function createFromResponse(\Psr\Http\Message\ResponseInterface $response)
    {
        $responseCode = $response->getStatusCode();

        if($responseCode == 401)
        {
            return new static('Unauthorized', 'API', ['Unauthorized request, please validate your credentials']);
        }
        else if($responseCode == 404){
            return new static('Not found', 'API', ['Given resource is not found, please verify the URL']);
        }
        else if($responseCode == 405){
            $body = (string)$response->getBody();

            $errorObject = @json_decode($body);
            return new static('Method not allowed', 'API', [$errorObject->message]);
        }
        else {
            $body = (string)$response->getBody();

            $errorObject = @json_decode($body);

            return new static($errorObject->message, $errorObject->code, $errorObject->errors);
        }
    }

    public static function general($message){
        return new static('Wedepa API error', 'API', [$message]);
    }

    /**
     * Get Wedepa error code
     * @return string
     */
    public function getWedepaCode(){
        return $this->wedepaCode;
    }

    /**
     * Get Wedepa error message
     * @return string
     */
    public function getWedepaMessage(){
        return $this->getMessage();
    }

    /**
     * Get Wedepa errors
     * @return array
     */
    public function getWedepaErrors(){
        return $this->errors;
    }
}