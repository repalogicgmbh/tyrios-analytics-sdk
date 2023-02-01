<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvent;
use stdClass;

class RemovefromCart extends WebEvent
{
    protected string $currency;
    protected string $value;
    protected array $items;
    protected ?string $coupon;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(string $currency,string $value,array $items,?string $browser_agent = null,
                                ?string $ip_address = null,
                                ?array $tags = [],
                                ?string $coupon = "",
                                ?string $userId = "",
                                ?string $sessionId = "",
    ){
        $this->extracted($currency,$this,$value,$items,$userId,$coupon,$tags,$sessionId,$browser_agent,$ip_address);

        $object["currency"] = $currency;
        $object["value"] = $value;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["coupon"] = $coupon;
        $object["items"] = $items;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "remove_from_cart", $object);
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
    public function extracted(string $currency,object $object,string $value,array $items,?string $userId="",?string $coupon="",
                              ?array $tags=[],?string $sessionId="",?string $browser_agent=null,?string $ip_address=null): void
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

