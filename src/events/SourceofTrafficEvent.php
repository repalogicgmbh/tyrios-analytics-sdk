<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use stdClass;

class SourceofTrafficEvent extends BasicEvent
{
    protected string $traffic_name;
    protected array $tags;
    protected string $userId;
    protected string $sessionId;

    public function __construct(string $traffic_name,  array $tags = [],string $userId="",string $sessionId="")
    {
        $this->extracted( $this, $traffic_name, $tags, $userId,  $sessionId);

        $object = new stdClass();

        $this->extracted( $object, $traffic_name, $tags, $userId,  $sessionId);

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = anonymizeIP($_SERVER['REMOTE_ADDR']) ?? null;
        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "source_of_traffic_event",$object,$userId,$sessionId,$tags,$browser_agent,$ip_address);
    }

    public function extracted(object $object, string $traffic_name, array $tags = [], string $userId = "", string $sessionId = ""): void
    {
        $object->traffic_name = $traffic_name;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
    }
}

