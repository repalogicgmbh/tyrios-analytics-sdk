<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use stdClass;

class ClickEvent extends BasicEvent
{
    protected string $click_name;
    protected string $click_type;
    protected array $tags;
    protected string $userId;
    protected string $sessionId;

    public function __construct(string $click_name, string $click_type, array $tags = [], string $userId="",string $sessionId="")
    {
        $this->extracted( $this, $click_name,$click_type, $tags, $userId,  $sessionId);

        $object = new stdClass();

        $this->extracted( $object, $click_name,$click_type, $tags, $userId,  $sessionId);

        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "click_event", $object);
    }
    public function extracted(object $object, string $click_name, string $click_type,array $tags = [], string $userId = "", string $sessionId = ""): void
    {
        $object->click_name = $click_name;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->click_type = $click_type;
        $object->sessionId = $sessionId;
    }
}

