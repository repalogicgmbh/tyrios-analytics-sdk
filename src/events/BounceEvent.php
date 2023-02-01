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
    protected string|null $ip_address;

    public function __construct(string $bounce_pageName,?string $browser_agent=null,?string $ip_address=null,
                                ?array $tags=[],
                                string $userId="",
                                string $sessionId=""
    ){
        $this->extracted($this,$bounce_pageName,$tags,$userId,$sessionId,$browser_agent,$ip_address);

        $object["bounce_pageName"] = $bounce_pageName;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "bounce_event", $object);

    }

    public function extracted(object $object,string $bounce_pageName,?array $tags=[],?string $userId="",?string $sessionId="",
                              ?string $browser_agent=null,?string $ip_address=null): void
    {
        $object->bounce_pageName = $bounce_pageName;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }

}

