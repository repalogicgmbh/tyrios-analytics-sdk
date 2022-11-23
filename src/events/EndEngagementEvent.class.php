<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use stdClass;

class EndEngagementEvent extends BasicEvent
{
    protected string $section_name;
    protected string $section_end_time_msec;
    protected array $tags;
    protected string $userId;
    protected string $sessionId;

    public function __construct(string $section_name, string $section_end_time_msec, array $tags = [], string $userId="", string $sessionId="")
    {
        $this->section_name = $section_name;
        $this->section_end_time_msec = $section_end_time_msec;
        $this->tags = $tags;
        $this->userId = $userId;
        $this->sessionId = $sessionId;
        $object = new stdClass();
        $object->section_name = $section_name;
        $object->section_end_time_msec = $section_end_time_msec;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;

        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "start_engagement_event",$object);
    }
}

