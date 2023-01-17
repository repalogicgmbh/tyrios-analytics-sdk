<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvent;

class FilterContent extends WebEvent
{
    protected array $filters;
    protected ?string $userId;
    protected ?string $sessionId;
    protected array $tags;

    public function __construct(array $filters,
                                array $tags = [],
                                string $userId = "",
                                string $sessionId = "",
    )
    {
        $this->extracted( $this, $filters, $tags,$userId,  $sessionId,);

        $object["filters"] = $filters;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;
        $object["tags"] = $tags;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = parent::anonymize_ip($_SERVER['REMOTE_ADDR']) ?? null;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                        date('Y-m-d H:i:s'), "ta_web", "filter_content", $object);
    }

    public function extracted(object $object,array $filters,array $tags ,string $userId,  string $sessionId): void
    {
        $object->filters = $filters;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
        $object->tags = $tags;
    }
}
