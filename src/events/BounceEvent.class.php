<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use stdClass;

class BounceEvent extends BasicEvent
{
    protected string $bounce_pageName;
    protected ?array $tags;
    protected string $userId;
    protected string $sessionId;

    public function __construct(string $bounce_pageName,  array $tags = [],string $userId="",string $sessionId="")
    {
        $this->extracted( $this, $bounce_pageName, $tags, $userId,  $sessionId);

        $object = new stdClass();

        $this->extracted( $object, $bounce_pageName, $tags, $userId,  $sessionId);
        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "bounce_event", $object);

    }

    public function extracted(object $object, string $bounce_pageName, array $tags = [], string $userId = "", string $sessionId = ""): void
    {
        $object->bounce_pageName = $bounce_pageName;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
    }

}

