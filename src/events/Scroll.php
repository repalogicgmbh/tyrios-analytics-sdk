<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvent;

class Scroll extends WebEvent
{
    protected string $section_name;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string $engagement_time_msec;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(string $section_name,string $engagement_time_msec,?string $browser_agent = null,
                                ?string $ip_address = null,
                                ?array $tags = [],
                                string $sessionId = "",
                                string $userId="",
    ){
        $this->section_name = $section_name;
        $this->tags = $tags;
        $this->sessionId = $sessionId;
        $this->userId = $userId;
        $this->engagement_time_msec = $engagement_time_msec;
        $this->browser_agent = $browser_agent;
        $this->ip_address = $ip_address;

        $object["section_name"] = $section_name;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;
        $object["engagement_time_msec"] = $engagement_time_msec;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "scroll",$object);
    }

}

