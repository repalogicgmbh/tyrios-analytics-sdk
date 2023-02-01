<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvent;

class UserEngagement extends WebEvent
{
    protected string $engagement_time_msec;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(string $engagement_time_msec,?string $browser_agent = null,?string $ip_address = null,
                                ?array $tags = [],
                                string $userId ="",
                                string $sessionId=""
    ){
        $this->engagement_time_msec = $engagement_time_msec;
        $this->tags = $tags;
        $this->userId = $userId;
        $this->sessionId = $sessionId;
        $this->browser_agent = $browser_agent;
        $this->ip_address = $ip_address;

        $object["engagement_time_msec"] = $engagement_time_msec;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "user_engagement",$object);
    }
}

