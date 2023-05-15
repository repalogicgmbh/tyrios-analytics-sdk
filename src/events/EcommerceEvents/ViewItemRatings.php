<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvent;

class ViewItemRatings extends WebEvent
{
    protected string $item_name;
    protected string $item_id;
    protected ?string $userId;
    protected ?string $sessionId;
    protected array|null $tags;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(string $item_name,string $item_id,?string $browser_agent = null,
                                ?string $ip_address = null,
                                ?array $tags = [],
                                string $userId = "",
                                string $sessionId = "",
    ){
        $this->extracted($this,$item_name,$item_id,$tags,$userId,$sessionId,$browser_agent,$ip_address);

        $object["item_name"] = $item_name;
        $object["item_id"] = $item_id;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;
        $object["tags"] = $tags;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d\TH:i:s'), "ta_web", "view_item_ratings",$object);
    }

    public function extracted(object $object,string $item_name,string $item_id,?array $tags=[],?string $userId="",
                              ?string $sessionId="",?string $browser_agent=null,?string $ip_address=null): void
    {
        $object->item_name = $item_name;
        $object->item_id = $item_id;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
        $object->tags = $tags;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }
}
