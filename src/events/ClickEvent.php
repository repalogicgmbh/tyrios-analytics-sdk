<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvent;

class ClickEvent extends WebEvent
{
    protected string $click_name;
    protected string $click_type;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(string $click_name,string $click_type,?string $browser_agent=null,?string $ip_address=null,
                                ?array $tags=[],
                                string $userId="",
                                string $sessionId=""
    ){
        $this->extracted($this,$click_name,$click_type,$tags,$userId,$sessionId,$browser_agent,$ip_address);

        $object["click_name"] = $click_name;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["click_type"] = $click_type;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "click_event", $object);
    }
    public function extracted(object $object,string $click_name,string $click_type,?array $tags=[],?string $userId="",
                              ?string $sessionId="",?string $browser_agent=null,?string $ip_address=null): void
    {
        $object->click_name = $click_name;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->click_type = $click_type;
        $object->sessionId = $sessionId;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }
}

