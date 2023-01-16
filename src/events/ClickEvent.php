<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvents;

class ClickEvent extends WebEvents
{
    protected string $click_name;
    protected string $click_type;
    protected array $tags;
    protected ?string $userId;
    protected ?string $sessionId;

    public function __construct(string $click_name, string $click_type, array $tags = [], string $userId="",string $sessionId="")
    {
        $this->extracted( $this, $click_name,$click_type, $tags, $userId,  $sessionId);

        $object["click_name"] = $click_name;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["click_type"] = $click_type;
        $object["sessionId"] = $sessionId;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = parent::anonymize_ip($_SERVER['REMOTE_ADDR']) ?? null;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "click_event", $object);
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

