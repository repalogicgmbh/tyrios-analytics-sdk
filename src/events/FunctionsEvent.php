<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvent;

class FunctionsEvent extends WebEvent
{
    protected string $function_name;
    protected string $function_value_selected;
    protected string $function_location_url;
    protected string $function_location;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(string $function_name,string $function_value_selected,string $function_location_url,
                                string $function_location,
                                ?string $browser_agent=null,
                                ?string $ip_address=null,
                                ?array $tags=[],
                                string $userId = "",
                                string $sessionId="")
    {
        $this->function_name = $function_name;
        $this->function_value_selected = $function_value_selected;
        $this->function_location_url = $function_location_url;
        $this->function_location = $function_location;
        $this->tags = $tags;
        $this->userId = $userId;
        $this->sessionId = $sessionId;
        $this->browser_agent = $browser_agent;
        $this->ip_address = $ip_address;

        $object["function_name"] = $function_name;
        $object["function_value_selected"] = $function_value_selected;
        $object["function_location_url"] = $function_location_url;
        $object["function_location"] = $function_location;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "functions_event",$object);
    }
}

