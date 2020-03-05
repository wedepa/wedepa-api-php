<?php


namespace Wedepa\Api\Endpoints;


use Wedepa\Api\Exceptions\WedepaException;
use Wedepa\Api\Resources\BaseResource;
use Wedepa\Api\WedepaClient;

abstract class EndpointAbstract
{
    /**
     * @var WedepaClient
     */
    private $client;

    public function __construct(WedepaClient $client)
    {
        $this->client = $client;
    }

    protected abstract function getResourcePath();

    /**
     * returns the object which is used by this endpoint.
     *
     * @return BaseResource
     */
    protected abstract function getResourceObject();

    /**
     * @return BaseResource
     * @throws WedepaException
     */
    public function get($id){
        $result = $this->client->performHttpGet(
            $this->getResourcePath() . '/' . $id
        );

        return $this->parseResource($result);
    }

    /**
     * @param array $params
     * @return BaseResource
     * @throws WedepaException
     */
    public function create($params){
        $result = $this->client->performHttpPost(
            $this->getResourcePath(),
            $params
        );

        return $this->parseResource($result);
    }

    /**
     * @param $result
     * @return BaseResource
     */
    private function parseResource($result){
        $resource = $this->getResourceObject();

        foreach($result as $param => $value){
            $resource->{$param} = $value;
        }

        return $resource;
    }
}