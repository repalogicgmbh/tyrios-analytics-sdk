<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use stdClass;

class UserEngagement extends BasicEvent
{
    protected string $engagement_time_msec;
    protected array $tags;
    protected string $userId;
    protected string $sessionId;

    public function __construct(string $engagement_time_msec,  string $userId ="",array $tags = [],string $sessionId="")
    {
        $this->engagement_time_msec = $engagement_time_msec;
        $this->tags = $tags;
        $this->userId = $userId;
        $this->sessionId = $sessionId;
        $object = new stdClass();
        $object->engagement_time_msec = $engagement_time_msec;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = anonymizeIP($_SERVER['REMOTE_ADDR']) ?? null;
        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "user_engagement",$object,$userId,$sessionId,$tags,$browser_agent,$ip_address);
    }
}

