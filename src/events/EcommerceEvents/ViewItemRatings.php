<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\BasicEvent;
use stdClass;

class ViewItemRatings extends BasicEvent
{
    protected string $item_name;
    protected string $item_id;
    protected string $userId;
    protected string $sessionId;
    protected array $tags;

    public function __construct(string $item_name,
                                string $item_id,
                                array $tags = [],
                                string $userId = "",
                                string $sessionId = "",
    )
    {
        $this->extracted( $this, $item_name,$item_id, $tags,$userId,  $sessionId,);
        $object = new stdClass();
        $this->extracted( $object, $item_name,$item_id, $tags,$userId,  $sessionId);

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = anonymizeIP($_SERVER['REMOTE_ADDR']) ?? null;
        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "view_item_ratings",$object,$userId,$sessionId,$tags,$browser_agent,$ip_address);
    }

    public function extracted(object $object,string $item_name,string $item_id, array $tags ,string $userId,  string $sessionId): void
    {
        $object->item_name = $item_name;
        $object->item_id = $item_id;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
        $object->tags = $tags;
    }
}
