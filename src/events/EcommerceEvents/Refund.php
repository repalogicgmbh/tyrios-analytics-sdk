<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvent;
use stdClass;

class Refund extends WebEvent
{
    protected string $currency;
    protected string $value;
    protected array $items;
    protected ?string $coupon;
    protected float $refund_amount;
    protected int $refund_quantity;
    protected string $reject_reason;
    protected ?float $tax;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(string $currency, string $value,float $refund_amount,int $refund_quantity,
                                string $reject_reason,
                                array $items,
                                ?string $browser_agent = null,
                                ?string $ip_address = null,
                                ?array $tags = [],
                                ?string $coupon = "",
                                ?float $tax = 0,
                                ?string $userId = "",
                                ?string $sessionId = "",
    )
    {
        $this->extracted($currency,$this,$value,$items,$refund_amount,$refund_quantity,$reject_reason,$userId,$coupon,
                        $tax,$tags,$sessionId,$browser_agent,$ip_address);

        $object["currency"] = $currency;
        $object["value"] = $value;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["coupon"] = $coupon;
        $object["refund_amount"] = $refund_amount;
        $object["refund_quantity"] = $refund_quantity;
        $object["reject_reason"] = $reject_reason;
        $object["tax"] = $tax;
        $object["items"] = $items;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "refund", $object);
    }


    /**
     * @param string $currency
     * @param stdClass $object
     * @param string $value
     * @param array|null $tags
     * @param string|null $userId
     * @param string|null $coupon
     * @param string $refund_amount
     * @param string $refund_quantity
     * @param string|null $tax
     * @param array $items
     * @param string|null $sessionId
     * @param string|null $browser_agent
     * @param string|null $ip_address
     * @return void
     */
    public function extracted(string $currency,object $object,string $value,array $items,float $refund_amount,int $refund_quantity,
                              string $reject_reason,?string $userId="",?string $coupon="",?float $tax=0,?array $tags=[],
                              ?string $sessionId="",?string $browser_agent=null,?string $ip_address=null): void
    {
        $object->currency = $currency;
        $object->value = $value;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->coupon = $coupon;
        $object->refund_amount = $refund_amount;
        $object->refund_quantity = $refund_quantity;
        $object->reject_reason = $reject_reason;
        $object->tax = $tax;
        $object->items = $items;
        $object->sessionId = $sessionId;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }
}

