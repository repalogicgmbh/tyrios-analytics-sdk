<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;


use repalogic\tyrios\analytics\data\SystemInformation;
use repalogic\tyrios\analytics\data\WebEvent;
use stdClass;

class ViewCart extends WebEvent
{
    protected string $currency;
    protected string $value;
    protected array $items;
    protected ?string $coupon;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string $ip_address;

    public function __construct(string $currency,string $value,array $items,
                                string $ip_address,
                                ?string $browser_agent = null,
                                ?string $coupon = "",
                                ?array $tags = [],
                                ?string $userId = "",
                                ?string $sessionId = "",
    )
    {
        $this->extracted($currency,$this,$value,$items,$ip_address,$browser_agent,$userId,$coupon,$tags,$sessionId);

        $object["currency"] = $currency;
        $object["value"] = $value;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["coupon"] = $coupon;
        $object["items"] = $items;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d\TH:i:s'), "ta_web", "view_cart", $object);
    }

    public function toJsonStruct(): array
    {
        $this->attributes["userId"] = $this->userId;
        $this->attributes["currency"] = $this->currency;
        $this->attributes["value"] = $this->value;
        $this->attributes["coupon"] = $this->coupon;
        $this->attributes["tags"] = $this->tags;
        $this->attributes["items"] = $this->items;
        $this->attributes["browser_agent"] = $this->browser_agent;
        $this->attributes["ip_address"] = $this->ip_address;
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
    public function extracted(string $currency,object $object,string $value,array $items,string $ip_address,?string $browser_agent=null,
                              ?string $userId="",?string $coupon="",?array $tags=[],?string $sessionId=""): void
    {
        $object->currency = $currency;
        $object->value = $value;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->coupon = $coupon;
        $object->items = $items;
        $object->sessionId = $sessionId;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }

}

