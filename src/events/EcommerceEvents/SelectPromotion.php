<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvent;

class SelectPromotion extends WebEvent
{
    protected string $creative_name;
    protected string $creative_slot;
    protected string $promotion_id;
    protected string $promotion_name;
    protected array $items;
    protected string $coupon;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(string $creative_name,string $creative_slot,string $promotion_id,string $promotion_name,array $items,
                                ?string $browser_agent = null,
                                ?string $ip_address = null,
                                ?array $tags = [],
                                ?string $userId = "",
                                ?string $sessionId = "",
    ){
        $this->extracted($creative_name,$this,$creative_slot,$promotion_id,$promotion_name,$items,$userId,$tags,$sessionId,$browser_agent,$ip_address);

        $object["creative_name"] = $creative_name;
        $object["creative_slot"] = $creative_slot;
        $object["promotion_id"] = $promotion_id;
        $object["promotion_name"] = $promotion_name;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["items"] = $items;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                        date('Y-m-d\TH:i:s'), "ta_web", "select_promotion",$object);
    }

    public function extracted(string $creative_name,object $object,string $creative_slot,string $promotion_id,string $promotion_name,
                              array $items,?string $userId="",?array $tags=[],?string $sessionId="",?string $browser_agent=null,?string $ip_address=null): void
    {
        $object->creative_name = $creative_name;
        $object->creative_slot = $creative_slot;
        $object->promotion_id = $promotion_id;
        $object->promotion_name = $promotion_name;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->items = $items;
        $object->sessionId = $sessionId;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }
}

