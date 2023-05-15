<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvent;
use stdClass;

class Purchase extends WebEvent
{
    protected string $currency;
    protected string $value;
    protected string $payment_mode;
    protected float $price;
    protected int $quantity;
    protected ?float $shipping_cost;
    protected ?float $tax;
    protected array $items;
    protected ?string $coupon;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(string $currency,string $value,string $payment_mode,float $price,int $quantity,array $items,
                                ?string $browser_agent = null,
                                ?string $ip_address = null,
                                ?float $shipping_cost = 0,
                                ?float $tax = 0,
                                ?string $coupon = "",
                                ?array $tags = [],
                                ?string $userId = "",
                                ?string $sessionId = "",
    ){
        $this->extracted($currency,$this,$value,$items,$payment_mode,$price,$quantity,$userId,$coupon,$tags,$sessionId,$shipping_cost,$tax,$browser_agent,$ip_address);

        $object["currency"] = $currency;
        $object["value"] = $value;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["coupon"] = $coupon;
        $object["items"] = $items;
        $object["sessionId"] = $sessionId;
        $object["payment_mode"] = $payment_mode;
        $object["quantity"] = $quantity;
        $object["price"] = $price;
        $object["shipping_cost"] = $shipping_cost;
        $object["tax"] = $tax;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d\TH:i:s'), "ta_web", "purchase", $object);
    }


    /**
     * @param string $currency
     * @param stdClass $object
     * @param string $value
     * @param array|null $tags
     * @param string|null $userId
     * @param string|null $coupon
     * @param array $items
     * @param string|null $sessionId
     * @param string|null $browser_agent
     * @param string|null $ip_address
     * @return void
     */
    public function extracted(string $currency,object $object,string $value,array $items,string $payment_mode,float $price,int $quantity,
                              ?string $userId="",?string $coupon="",?array $tags=[],?string $sessionId="",?float $shipping_cost=0,
                              ?float $tax=0,?string $browser_agent=null,?string $ip_address=null): void
    {
        $object->currency = $currency;
        $object->value = $value;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->coupon = $coupon;
        $object->items = $items;
        $object->sessionId = $sessionId;
        $object->payment_mode = $payment_mode;
        $object->quantity = $quantity;
        $object->price = $price;
        $object->shipping_cost = $shipping_cost;
        $object->tax = $tax;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }

}

