<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvent;

class ErrorEvent extends WebEvent
{
    protected string $error_message;
    protected string $error_type;
    protected string $error_stacktrace;
    protected string $error_location;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(string $error_message,string $error_type,string $error_stacktrace,string $error_location,
                                ?string $browser_agent = null,
                                ?string $ip_address = null,
                                ?array $tags = [],
                                string $userId = "",
                                string $sessionId=""
    ){
        $this->error_message = $error_message;
        $this->error_type = $error_type;
        $this->error_stacktrace = $error_stacktrace;
        $this->error_location = $error_location;
        $this->tags = $tags;
        $this->userId = $userId;
        $this->sessionId = $sessionId;
        $this->browser_agent = $browser_agent;
        $this->ip_address = $ip_address;

        $object["error_message"] = $error_message;
        $object["error_type"] = $error_type;
        $object["error_stacktrace"] = $error_stacktrace;
        $object["error_location"] = $error_location;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "error_event",$object);
    }
}

