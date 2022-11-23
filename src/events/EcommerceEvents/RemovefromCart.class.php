<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use stdClass;

class RemovefromCart extends BasicEvent
{
    protected string $currency;
    protected string $value;
    protected $items;
    protected ?string $coupon;
    protected ?array $tags;
    protected ?string $userId;
    protected ?string $sessionId;

    public function __construct(string $currency, string $value, $items,string $coupon = "", array $tags = [],
                                string $userId = "",
                                string $sessionId = "",
    )
    {
        $this->extracted($currency, $this, $value, $tags, $userId, $coupon,  $items, $sessionId);

        $object = new stdClass();

        $this->extracted($currency, $object, $value, $tags, $userId, $coupon,  $items, $sessionId);

        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "remove_from_cart", $object);
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
    public function extracted(string $currency, object $object, string $value, ?array $tags, ?string $userId, ?string $coupon, array $items, ?string $sessionId): void
    {
        $object->currency = $currency;
        $object->value = $value;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->coupon = $coupon;
        $object->items = $items;
        $object->sessionId = $sessionId;
    }

}

