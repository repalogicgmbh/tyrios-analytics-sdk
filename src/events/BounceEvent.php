<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvents;

class BounceEvent extends WebEvents
{
    protected string $bounce_pageName;
    protected array $tags;
    protected ?string $userId;
    protected ?string $sessionId;

    public function __construct(string $bounce_pageName,  array $tags = [],string $userId="",string $sessionId="")
    {
        $this->extracted( $this, $bounce_pageName, $tags, $userId,  $sessionId);

        $object["bounce_pageName"] = $bounce_pageName;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = parent::anonymize_ip($_SERVER['REMOTE_ADDR']) ?? null;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "bounce_event", $object);

    }

    public function extracted(object $object, string $bounce_pageName, array $tags = [], string $userId = "", string $sessionId = ""): void
    {
        $object->bounce_pageName = $bounce_pageName;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
    }

}

