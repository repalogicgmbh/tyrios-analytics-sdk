<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvent;

class AdClick extends WebEvent
{
    protected string $ad_event_id;
    protected string $ad_location;
    protected array $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string $ad_url;

    public function __construct(string $ad_event_id,
                                string $ad_location,
                                string $ad_url,
                                array $tags = [],
                                string $userId = "",
                                string $sessionId=""
    )
    {
        $this->extracted( $this, $ad_event_id,$ad_location,$ad_url, $tags, $userId,  $sessionId);

        $object["ad_event_id"] = $ad_event_id;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["ad_location"] = $ad_location;
        $object["ad_url"] = $ad_url;
        $object["sessionId"] = $sessionId;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = parent::anonymize_ip($_SERVER['REMOTE_ADDR']) ?? null;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "ad_click", $object);
    }

    public function extracted(object $object, string $ad_event_id, string $ad_location,string $ad_url,array $tags = [], string $userId="", string $sessionId=""): void
    {
        $object->ad_event_id = $ad_event_id;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->ad_location = $ad_location;
        $object->ad_url = $ad_url;
        $object->sessionId = $sessionId;
    }
}

