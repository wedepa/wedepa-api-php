<?php


namespace Wedepa\Api\Endpoints;


use Wedepa\Api\Exceptions\WedepaException;
use Wedepa\Api\Resources\BaseResource;
use Wedepa\Api\Resources\Refund;

class RefundEndpoint extends EndpointAbstract
{
    protected $hasParent = true;

    protected function getResourcePath()
    {
        return 'payment/%s/refund';
    }

    /**
     * @inheritDoc
     */
    protected function getResourceObject()
    {
        return new Refund();
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