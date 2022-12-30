<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use stdClass;

class Refund extends BasicEvent
{
    protected string $currency;
    protected string $value;
    protected array $items;
    protected ?string $coupon;
    protected float $refund_amount;
    protected int $refund_quantity;
    protected string $reject_reason;
    protected ?float $tax;
    protected array $tags;
    protected ?string $userId;
    protected ?string $sessionId;

    public function __construct(string $currency, string $value,
                                float $refund_amount,
                                int $refund_quantity,
                                string $reject_reason,
                                array $items,
                                string $coupon = "",
                                ?float $tax = 0,
                                array $tags = [],
                                string $userId = "",
                                string $sessionId = "",
    )
    {
        $this->extracted($currency, $this, $value, $tags, $userId, $coupon, $refund_amount, $refund_quantity,$reject_reason, $tax, $items, $sessionId);

        $object = new stdClass();

        $this->extracted($currency, $object, $value, $tags, $userId, $coupon, $refund_amount, $refund_quantity,$reject_reason, $tax, $items, $sessionId);

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = anonymizeIP($_SERVER['REMOTE_ADDR']) ?? null;
        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "refund", $object,$userId,$sessionId,$tags,$browser_agent,$ip_address);
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
     * @return void
     */
    public function extracted(string $currency, object $object, string $value, ?array $tags, ?string $userId, ?string $coupon, float $refund_amount, int $refund_quantity,string $reject_reason, ?float $tax,array $items, ?string $sessionId): void
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
    }
}

