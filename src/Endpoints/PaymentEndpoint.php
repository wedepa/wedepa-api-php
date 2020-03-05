<?php


namespace Wedepa\Api\Endpoints;


use Wedepa\Api\Resources\Payment;

class PaymentEndpoint extends EndpointAbstract
{
    protected function getResourcePath()
    {
        return 'payment';
    }

    /**
     * @return Payment
     */
    protected function getResourceObject()
    {
        return new Payment();
    }
}