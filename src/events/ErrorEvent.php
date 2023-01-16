<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvents;

class ErrorEvent extends WebEvents
{
    protected string $error_message;
    protected string $error_type;
    protected string $error_stacktrace;
    protected string $error_location;
    protected array $tags;
    protected ?string $userId;
    protected ?string $sessionId;

    public function __construct(string $error_message, string $error_type, string $error_stacktrace,string $error_location, array $tags = [], string $userId = "", string $sessionId="")
    {
        $this->error_message = $error_message;
        $this->error_type = $error_type;
        $this->error_stacktrace = $error_stacktrace;
        $this->error_location = $error_location;
        $this->tags = $tags;
        $this->userId = $userId;
        $this->sessionId = $sessionId;

        $object["error_message"] = $error_message;
        $object["error_type"] = $error_type;
        $object["error_stacktrace"] = $error_stacktrace;
        $object["error_location"] = $error_location;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = parent::anonymize_ip($_SERVER['REMOTE_ADDR']) ?? null;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "error_event",$object);
    }
}

