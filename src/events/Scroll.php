<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvents;

class Scroll extends WebEvents
{
    protected string $section_name;
    protected array $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string $engagement_time_msec;

    public function __construct(string $section_name,
                                string $engagement_time_msec,array  $tags = [],
                                string $sessionId = "",
                                string $userId="",
    )
    {
        $this->section_name = $section_name;
        $this->tags = $tags;
        $this->sessionId = $sessionId;
        $this->userId = $userId;
        $this->engagement_time_msec = $engagement_time_msec;

        $object["section_name"] = $section_name;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;
        $object["engagement_time_msec"] = $engagement_time_msec;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = parent::anonymize_ip($_SERVER['REMOTE_ADDR']) ?? null;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "scroll",$object);
    }

}

