<?php namespace Wedepa\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use stdClass;
use Wedepa\Api\Endpoints\CaptureEndpoint;
use Wedepa\Api\Endpoints\PaymentEndpoint;
use Wedepa\Api\Endpoints\RefundEndpoint;
use Wedepa\Api\Exceptions\WedepaException;

/**
*  Wedepa Client
*
*  Client class for the Wedepa API.
*  This class contains all the important functions
*
*  @author Wedepa
*/
class WedepaClient{

    /**
     * Website ID
     * @var string
     */
    private $_websiteId = '';

    /**
     * Website Secret
     * @var string
     */
    private $_secret = '';

    /**
     * current API version
     */
    private const api_version = 'v1';

    /**
     * URL to Wedepa API
     */
    private const api_url = 'https://api.wedepa.com';

    /**
     * @var CaptureEndpoint
     */
    public $capture;

    /**
     * @var PaymentEndpoint
     */
    public $payments;

    /**
     * @var RefundEndpoint
     */
    public $refunds;

    /**
     * WedepaClient constructor.
     * @param $websiteId
     * @param $secret
     */
    public function __construct($websiteId, $secret)
    {
        $this->_websiteId = $websiteId;
        $this->_secret = $secret;

        // init endpoints
        $this->capture = new CaptureEndpoint($this);
        $this->payments = new PaymentEndpoint($this);
        $this->refunds = new RefundEndpoint($this);
    }

    /**
     * Perform HTTP Post to Wedepa API
     * @param string $resource
     * @return stdClass|null
     * @throws WedepaException
     */
    public function performHttpGet($resource){
        return $this->performHttpCall('GET', $resource);
    }

    /**
     * Perform HTTP Post to Wedepa API
     * @param string $resource
     * @param array $params
     * @return stdClass|null
     * @throws WedepaException
     */
    public function performHttpPost($resource, $params){
        return $this->performHttpCall('POST', $resource, \GuzzleHttp\json_encode($params));
    }

    /**
     * @param $method
     * @param $resource
     * @param string|null $body
     * @return stdClass|null
     * @throws WedepaException
     */
    private function performHttpCall($method, $resource, $body = null){
        // generate URL
        $url = sprintf('%s/%s/%s', self::api_url, self::api_version, $resource);

        // set headers
        $headers = [
            'Accept' => "application/json",
            'Content-Type' => "application/json",
            'website-id' => $this->_websiteId,
        ];

        // add client information
        if (function_exists("php_uname")) {
            $headers['X-Client-Info'] = php_uname();
        }

        // generate request
        $request = new Request($method, $url, $headers, $body);

        try{
            $httpClient = new Client([
                RequestOptions::TIMEOUT => 10
            ]);

            $response = $httpClient->send($request, [RequestOptions::HTTP_ERRORS => false]);
        }
        catch (GuzzleException $e){
            throw WedepaException::createFromGuzzleException($e);
        }

        if(empty($response)){
            throw WedepaException::general('No API response received');
        }

        // do we have a no content response?
        if($response->getStatusCode() == 204){
            return null;
        }
        // do we have an error response?
        else if($response->getStatusCode() >= 400){
            throw WedepaException::createFromResponse($response);
        }
        // else we must have a response
        else{
            // load body
            $responseBody = (string)$response->getBody();

            // body empty?
            if(empty($responseBody)){
                throw WedepaException::general('No API response body received');
            }

            // parse body
            $defaultObject = json_decode($responseBody);

            // parse error?
            if(json_last_error() !== JSON_ERROR_NONE){
                throw WedepaException::general("Error in received JSON ({$responseBody})");
            }

            return $defaultObject;
        }
    }
}