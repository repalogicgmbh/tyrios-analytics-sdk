<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use stdClass;

class Purchase extends BasicEvent
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
    protected ?array $tags;
    protected ?string $userId;
    protected ?string $sessionId;

    public function __construct(string $currency, string $value, string $payment_mode, float $price, int $quantity,array $items,
                                float $shipping_cost = 0,
                                float $tax = 0,string $coupon = "", array $tags = [],
                                string $userId = "",
                                string $sessionId = "",
    )
    {
        $this->extracted($currency, $this, $value, $tags, $userId, $coupon, $items, $sessionId,
            $payment_mode, $price, $quantity, $shipping_cost, $tax
        );

        $object = new stdClass();

        $this->extracted($currency, $object, $value, $tags, $userId, $coupon, $items, $sessionId,
            $payment_mode, $price, $quantity, $shipping_cost, $tax
        );

        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "purchase", $object);
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
     * @return void
     */
    public function extracted(string $currency, object $object, string $value,  $tags , ?string $userId, ?string $coupon, array $items, ?string $sessionId,
                              string $payment_mode, float $price, int $quantity, ?float $shipping_cost, ?float $tax
    ): void
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
    }

}

