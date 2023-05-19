<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvent;

class BounceEvent extends WebEvent
{
    protected string $bounce_pageName;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string $ip_address;

    public function __construct(string $bounce_pageName,string $ip_address,?string $browser_agent=null,
                                ?array $tags=[],
                                string $userId="",
                                string $sessionId=""
    ){
        $this->extracted($this,$bounce_pageName,$ip_address,$browser_agent,$tags,$userId,$sessionId);

        $object["bounce_pageName"] = $bounce_pageName;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d\TH:i:s'), "ta_web", "bounce_event", $object);

    }

    public function extracted(object $object,string $bounce_pageName,string $ip_address,?string $browser_agent=null,
                              ?array $tags=[],?string $userId="",?string $sessionId=""): void
    {
        $object->bounce_pageName = $bounce_pageName;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }

}

