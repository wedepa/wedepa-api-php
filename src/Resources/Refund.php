<?php


namespace Wedepa\Api\Resources;


class Refund
{
    /**
     * @var \stdClass
     */
    public $amount;

    /**
     * @var string
     */
    public $created_at;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $provider_id;

    /**
     * @var string
     */
    public $refund_id;

    /**
     * @var string
     */
    public $status;

    /**
     * @var array
     */
    public $products;
}