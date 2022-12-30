<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use stdClass;

class SessionStart extends BasicEvent
{
    protected string $start_session_id;
    protected array $tags;
    protected string $userId;
    protected string $sessionId;

    public function __construct(string $start_session_id,array  $tags = [], string $userId = "", string $sessionId = "")
    {
        $this->start_session_id = $start_session_id;
        $this->tags = $tags;
        $this->userId = $userId;
        $this->sessionId = $sessionId;
        $object = new stdClass();
        $object->start_session_id = $start_session_id;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = anonymizeIP($_SERVER['REMOTE_ADDR']) ?? null;
        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "session_start",$object,$userId,$sessionId,$tags,$browser_agent,$ip_address);
    }
}

