<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\BasicEvent;
use stdClass;

class NoItemsFound extends BasicEvent
{
    protected string $item_search_name;
    protected array $item_filters;
    protected string $userId;
    protected string $sessionId;
    protected array $tags;

    public function __construct(string $item_search_name,
                                array $item_filters =[],
                                array $tags = [],
                                string $userId = "",
                                string $sessionId = "",
    )
    {
        $this->extracted( $this, $item_search_name,$item_filters, $tags,$userId,  $sessionId,);
        $object = new stdClass();
        $this->extracted( $object, $item_search_name,$item_filters, $tags,$userId,  $sessionId);

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = anonymizeIP($_SERVER['REMOTE_ADDR']) ?? null;
        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "no_items_found", $object,$userId,$sessionId,$tags,$browser_agent,$ip_address);
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
