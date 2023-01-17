<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvent;

class FirstVisit extends WebEvent
{
    protected string $ip_address;
    protected array $tags;
    protected ?string $userId;
    protected string $traffic_name;
    protected ?string $sessionId;

    public function __construct( string $traffic_name,
                                string $ip_address = "",array  $tags = [], string $userId ="",
                                string $sessionId = ""
    )
    {
        $this->extracted( $this, $traffic_name,$ip_address, $tags, $userId,  $sessionId);

        $object["traffic_name"] = $traffic_name;
        $object["ip_address"] = $ip_address;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "first_visit",$object);
    }
    public function extracted(object $object, string $traffic_name,string  $ip_address, array $tags = [], string $userId="", string $sessionId=""): void
    {
        $object->traffic_name = $traffic_name;
        $object->ip_address = $ip_address;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
    }
}

