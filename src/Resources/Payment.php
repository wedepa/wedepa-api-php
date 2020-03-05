<?php


namespace Wedepa\Api\Resources;


class Payment extends BaseResource
{
    /**
     * @var \stdClass
     */
    public $amount;

    /**
     * @var string
     */
    public $custom;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $ip_address;

    /**
     * @var string
     */
    public $ip_continent;

    /**
     * @var string
     */
    public $ip_country;

    /**
     * @var string
     */
    public $locale;

    /**
     * @var string
     */
    public $method;

    /**
     * @var string
     */
    public $order_id;

    /**
     * @var string
     */
    public $payment_id;

    /**
     * @var string
     */
    public $provider;

    /**
     * @var string
     */
    public $status;

    /**
     * @var boolean
     */
    public $test;

    /**
     * @var \stdClass
     */
    public $url;

    /**
     * @var \stdClass
     */
    public $billing;

    /**
     * @var \stdClass
     */
    public $shipping;

    /**
     * @var array
     */
    public $products;
}