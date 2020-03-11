<?php


namespace Wedepa\Api\Resources;


class Payment extends BaseResource
{
    /**
     * @var \stdClass
     */
    public $amount;

    /**
     * @var \stdClass
     */
    public $paid_amount;

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

    /**
     * Redirect consumer to success page
     * @return boolean
     */
    public function redirectToSuccess()
    {
        return
            $this->isStatusOpen() ||
            $this->isStatusAuthorized() ||
            $this->isStatusPaid() ||
            $this->isStatusPaidPartial() ||
            $this->isStatusPending();
    }

    /**
     * Validate if payment status is open
     * @return bool
     */
    public function isStatusOpen()
    {
        return $this->status == 'open';
    }

    /**
     * Validate if payment status is failed
     * @return bool
     */
    public function isStatusFailed()
    {
        return $this->status == 'failed';
    }

    /**
     * Validate if payment status is authorized
     * @return bool
     */
    public function isStatusAuthorized()
    {
        return $this->status == 'authorized';
    }

    /**
     * Validate if payment status is denied
     * @return bool
     */
    public function isStatusDenied()
    {
        return $this->status == 'denied';
    }

    /**
     * Validate if payment status is cancel
     * @return bool
     */
    public function isStatusCancel()
    {
        return $this->status == 'cancel';
    }

    /**
     * Validate if payment status is refund_partial
     * @return bool
     */
    public function isStatusRefundPartial()
    {
        return $this->status == 'refund_partial';
    }

    /**
     * Validate if payment status is refund
     * @return bool
     */
    public function isStatusRefund()
    {
        return $this->status == 'refund';
    }

    /**
     * Validate if payment status is paid_partial
     * @return bool
     */
    public function isStatusPaidPartial()
    {
        return $this->status == 'paid_partial';
    }

    /**
     * Validate if payment status is paid
     * @return bool
     */
    public function isStatusPaid()
    {
        return $this->status == 'paid';
    }

    /**
     * Validate if payment status is expired
     * @return bool
     */
    public function isStatusExpired()
    {
        return $this->status == 'expired';
    }

    /**
     * Validate if payment status is pending
     * @return bool
     */
    public function isStatusPending()
    {
        return $this->status == 'pending';
    }
}