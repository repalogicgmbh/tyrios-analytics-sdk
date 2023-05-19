<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvent;

class SessionStart extends WebEvent
{
    protected string $start_session_id;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string $ip_address;

    public function __construct(string $start_session_id,string $ip_address,
                                ?string $browser_agent = null,
                                ?array $tags = [],
                                string $userId = "",
                                string $sessionId = ""
    ){
        $this->start_session_id = $start_session_id;
        $this->tags = $tags;
        $this->userId = $userId;
        $this->sessionId = $sessionId;
        $this->browser_agent = $browser_agent;
        $this->ip_address = $ip_address;

        $object["start_session_id"] = $start_session_id;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d\TH:i:s'), "ta_web", "session_start",$object);
    }
}

