<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;


use repalogic\tyrios\analytics\data\SystemInformation;
use repalogic\tyrios\analytics\data\WebEvents;
use stdClass;

class ViewCart extends WebEvents
{
    protected string $currency;
    protected string $value;
    protected array $items;
    protected ?string $coupon;
    protected array $tags;
    protected ?string $userId;
    protected ?string $sessionId;


    public function __construct(string $currency, string $value, $items,string $coupon = "", array $tags = [],
                                string $userId = "",
                                string $sessionId = "",
    )
    {
        $this->extracted($currency, $this, $value, $tags, $userId, $coupon,  $items, $sessionId);

        $object["currency"] = $currency;
        $object["value"] = $value;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["coupon"] = $coupon;
        $object["items"] = $items;
        $object["sessionId"] = $sessionId;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = parent::anonymize_ip($_SERVER['REMOTE_ADDR']) ?? null;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "view_cart", $object);
    }

    public function toJsonStruct(): array
    {
        $this->attributes["userId"] = $this->userId;
        $this->attributes["currency"] = $this->currency;
        $this->attributes["value"] = $this->value;
        $this->attributes["coupon"] = $this->coupon;
        $this->attributes["tags"] = $this->tags;
        $this->attributes["items"] = $this->items;
        $this->attributes["systemInformation"] = SystemInformation::getSystemInfo();
        return parent::toJsonStruct();
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

