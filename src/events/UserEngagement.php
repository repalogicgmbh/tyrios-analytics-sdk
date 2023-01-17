<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvent;

class UserEngagement extends WebEvent
{
    protected string $engagement_time_msec;
    protected array $tags;
    protected ?string $userId;
    protected ?string $sessionId;

    public function __construct(string $engagement_time_msec,  string $userId ="",array $tags = [],string $sessionId="")
    {
        $this->engagement_time_msec = $engagement_time_msec;
        $this->tags = $tags;
        $this->userId = $userId;
        $this->sessionId = $sessionId;

        $object["engagement_time_msec"] = $engagement_time_msec;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = parent::anonymize_ip($_SERVER['REMOTE_ADDR']) ?? null;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "user_engagement",$object);
    }
}

