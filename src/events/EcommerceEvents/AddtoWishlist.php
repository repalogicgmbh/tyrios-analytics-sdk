<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvent;
use stdClass;

class AddToWishList extends WebEvent
{
    protected string $currency;
    protected string $value;
    protected array $items;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string $ip_address;

    public function __construct(string $currency, string $value,array $items,
                                string $ip_address,
                                ?string $browser_agent = null,
                                ?array $tags = [],
                                ?string $userId = "",
                                ?string $sessionId = "",
    ){
        $this->extracted($currency,$this,$value,$items,$ip_address,$browser_agent,$tags,$userId,$sessionId);

        $object["currency"] = $currency;
        $object["value"] = $value;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["items"] = $items;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d\TH:i:s'), "ta_web", "add_to_wishlist", $object);
    }



    /**
     * @param string $currency
     * @param stdClass $object
     * @param string $value
     * @param array|null $tags
     * @param string|null $userId
     * @param array $items
     * @param string|null $sessionId
     * @param string|null $browser_agent
     * @param string $ip_address
     * @return void
     */
    public function extracted(string $currency,object $object,string $value,array $items,string $ip_address,?string $browser_agent=null,
                              ?array $tags=[],?string $userId="",?string $sessionId=""): void
    {
        $object->currency = $currency;
        $object->value = $value;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->items = $items;
        $object->sessionId = $sessionId;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }

}

