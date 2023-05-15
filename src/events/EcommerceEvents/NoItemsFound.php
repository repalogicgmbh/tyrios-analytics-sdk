<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvent;

class NoItemsFound extends WebEvent
{
    protected string $item_search_name;
    protected array|null $item_filters;
    protected ?string $userId;
    protected ?string $sessionId;
    protected array|null $tags;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(string $item_search_name,?string $browser_agent = null,
                                ?string $ip_address = null,
                                ?array $tags = [],
                                ?array $item_filters =[],
                                ?string $userId = "",
                                ?string $sessionId = "",
    ){
        $this->extracted($this,$item_search_name,$item_filters,$tags,$userId,$sessionId,$browser_agent,$ip_address);

        $object["item_search_name"] = $item_search_name;
        $object["item_filters"] = $item_filters;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;
        $object["tags"] = $tags;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d\TH:i:s'), "ta_web", "no_items_found", $object);
    }

    public function extracted(object $object,string $item_search_name,?array $item_filters,?array $tags=[],?string $userId="",
                              ?string $sessionId="",?string $browser_agent=null,?string $ip_address=null): void
    {
        $object->item_search_name = $item_search_name;
        $object->item_filters = $item_filters;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
        $object->tags = $tags;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }
}
