<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvent;

class NoItemsFound extends WebEvent
{
    protected string $item_search_name;
    protected array $item_filters;
    protected ?string $userId;
    protected ?string $sessionId;
    protected array $tags;

    public function __construct(string $item_search_name,
                                array $item_filters =[],
                                array $tags = [],
                                string $userId = "",
                                string $sessionId = "",
    )
    {
        $this->extracted( $this, $item_search_name,$item_filters, $tags,$userId,  $sessionId,);

        $object["item_search_name"] = $item_search_name;
        $object["item_filters"] = $item_filters;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;
        $object["tags"] = $tags;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = parent::anonymize_ip($_SERVER['REMOTE_ADDR']) ?? null;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "no_items_found", $object);
    }

    public function extracted(object $object,string $item_search_name,array $item_filters, array $tags ,string $userId,  string $sessionId): void
    {
        $object->item_search_name = $item_search_name;
        $object->item_filters = $item_filters;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
        $object->tags = $tags;
    }
}
