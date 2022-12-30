<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use stdClass;

class FunctionsEvent extends BasicEvent
{
    protected string $function_name;
    protected string $function_value_selected;
    protected string $function_location_url;
    protected string $function_location;
    protected array $tags;
    protected string $userId;
    protected string $sessionId;

    public function __construct(string $function_name, string $function_value_selected, string $function_location_url,string $function_location, array $tags = [], string $userId = "", string $sessionId="")
    {
        $this->function_name = $function_name;
        $this->function_value_selected = $function_value_selected;
        $this->function_location_url = $function_location_url;
        $this->function_location = $function_location;
        $this->tags = $tags;
        $this->userId = $userId;
        $this->sessionId = $sessionId;
        $object = new stdClass();
        $object->function_name = $function_name;
        $object->function_value_selected = $function_value_selected;
        $object->function_location_url = $function_location_url;
        $object->function_location = $function_location;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = anonymizeIP($_SERVER['REMOTE_ADDR']) ?? null;
        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "functions_event",$object,$userId,$sessionId,$tags,$browser_agent,$ip_address);
    }
}

