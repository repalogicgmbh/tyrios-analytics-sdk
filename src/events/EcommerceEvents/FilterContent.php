<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvent;

class FilterContent extends WebEvent
{
    protected array $filters;
    protected ?string $userId;
    protected ?string $sessionId;
    protected array|null $tags;
    protected string|null $browser_agent;
    protected string $ip_address;

    public function __construct(array $filters,string $ip_address,?string $browser_agent = null,
                                ?array $tags = [],
                                ?string $userId = "",
                                ?string $sessionId = "",
    ){
        $this->extracted($this,$filters,$ip_address,$browser_agent,$tags,$userId,$sessionId);

        $object["filters"] = $filters;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;
        $object["tags"] = $tags;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                        date('Y-m-d\TH:i:s'), "ta_web", "filter_content", $object);
    }

    public function extracted(object $object,array $filters,string $ip_address,?string $browser_agent=null,
                              ?array $tags=[],?string $userId="",?string $sessionId=""): void
    {
        $object->filters = $filters;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
        $object->tags = $tags;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }
}
