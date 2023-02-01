<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvent;

class EndEngagementEvent extends WebEvent
{
    protected string $section_name;
    protected string $section_end_time_msec;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(string $section_name,string $section_end_time_msec,?string $browser_agent=null,?string $ip_address=null,
                                ?array $tags=[],
                                string $userId="",
                                string $sessionId=""
    ){
        $this->section_name = $section_name;
        $this->section_end_time_msec = $section_end_time_msec;
        $this->tags = $tags;
        $this->userId = $userId;
        $this->sessionId = $sessionId;
        $this->browser_agent = $browser_agent;
        $this->ip_address = $ip_address;

        $object["section_name"] = $section_name;
        $object["section_end_time_msec"] = $section_end_time_msec;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "start_engagement_event",$object);
    }
}

