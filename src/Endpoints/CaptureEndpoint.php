<?php


namespace Wedepa\Api\Endpoints;


use Wedepa\Api\Exceptions\WedepaException;
use Wedepa\Api\Resources\BaseResource;
use Wedepa\Api\Resources\Capture;

class CaptureEndpoint extends EndpointAbstract
{
    /**
     * @var bool
     */
    protected $hasParent = true;

    protected function getResourcePath()
    {
        return 'payment/%s/capture';
    }

    /**
     * @inheritDoc
     */
    protected function getResourceObject()
    {
        return new Capture();
    }

    /**
     * @param array $params
     * @param bool $execute
     * @return BaseResource
     * @throws WedepaException
     */
    public function create($params, $execute = false)
    {
        return parent::create($params, $execute ? ['execute' => 'true'] : null);
    }
}