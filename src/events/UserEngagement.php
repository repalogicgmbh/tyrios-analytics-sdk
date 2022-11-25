<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use stdClass;

class UserEngagement extends BasicEvent
{
    protected $engagement_time_msec;
    protected $tags;
    protected $userId;
    protected $sessionId;

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

        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "user_engagement",$object);
    }
}

