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
    protected string|null $ip_address;

    public function __construct(array $filters,?string $browser_agent = null,?string $ip_address = null,
                                ?array $tags = [],
                                ?string $userId = "",
                                ?string $sessionId = "",
    ){
        $this->extracted($this,$filters,$tags,$userId,$sessionId,$browser_agent,$ip_address);

        $object["filters"] = $filters;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;
        $object["tags"] = $tags;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                        date('Y-m-d\TH:i:s'), "ta_web", "filter_content", $object);
    }

    public function extracted(object $object,array $filters,?array $tags=[],?string $userId="",?string $sessionId="",
                              ?string $browser_agent=null,?string $ip_address=null): void
    {
        $object->filters = $filters;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
        $object->tags = $tags;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }
}
