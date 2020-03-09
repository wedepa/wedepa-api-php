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

    /**
     * Endpoint has parent
     * @var bool
     */
    protected $hasParent = false;

    /**
     * Parent ID
     * @var string
     */
    private $parentId = null;

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
     * @param $id
     * @return BaseResource
     * @throws WedepaException
     */
    public function get($id){
        $result = $this->client->performHttpGet(
            $this->formatResourcePath() . '/' . $id
        );

        // reset parent ID
        $this->parentId = null;

        return $this->parseResource($result);
    }

    /**
     * @param array $params
     * @param null $query
     * @return BaseResource
     * @throws WedepaException
     */
    public function create($params, $query = null){
        $result = $this->client->performHttpPost(
            $this->formatResourcePath() . (is_null($query) || !is_array($query) ? '' : '?' . http_build_query($query)),
            $params
        );

        // reset parent ID
        $this->parentId = null;

        return $this->parseResource($result);
    }


    /**
     * Set parent ID
     * @param $parentId
     */
    public function setParent($parentId){
        $this->parentId = $parentId;
    }

    /**
     * @param $result
     * @return BaseResource
     */
    private function parseResource($result)
    {
        $resource = $this->getResourceObject();

        foreach ($result as $param => $value) {
            $resource->{$param} = $value;
        }

        return $resource;
    }

    private function formatResourcePath()
    {
        if($this->hasParent)
        {
            if(is_null($this->parentId) || empty($this->parentId))
            {
                throw new WedepaException('No parent ID set', 'api', 'No parent ID set for resource');
            }

            return sprintf($this->getResourcePath(), $this->parentId);
        }
        else{
            return $this->getResourcePath();
        }
    }
}