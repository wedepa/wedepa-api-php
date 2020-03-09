<?php


namespace Wedepa\Api\Resources;


class Capture
{
    /**
     * @var \stdClass
     */
    public $amount;

    /**
     * @var string
     */
    public $capture_id;

    /**
     * @var string
     */
    public $created_at;

    /**
     * @var bool
     */
    public $final;

    /**
     * @var string
     */
    public $provider_id;

    /**
     * @var string
     */
    public $status;

    /**
     * @var array
     */
    public $products;

    /**
     * Is capture status open
     * @return bool
     */
    public function isStatusOpen(){
        return $this->status == 'open';
    }

    /**
     * Is capture status pending
     * @return bool
     */
    public function isStatusPending(){
        return $this->status == 'pending';
    }

    /**
     * Is capture status cancel
     * @return bool
     */
    public function isStatusCancel(){
        return $this->status == 'cancel';
    }

    /**
     * Is capture status success
     * @return bool
     */
    public function isStatusSuccess(){
        return $this->status == 'success';
    }

    /**
     * Is capture status failed
     * @return bool
     */
    public function isStatusFailed(){
        return $this->status == 'failed';
    }
}