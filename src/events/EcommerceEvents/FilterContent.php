<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\BasicEvent;
use stdClass;

class FilterContent extends BasicEvent
{
    protected array $filters;
    protected string $userId;
    protected string $sessionId;
    protected array $tags;

    public function __construct(array $filters,
                                array $tags = [],
                                string $userId = "",
                                string $sessionId = "",
    )
    {
        $this->extracted( $this, $filters, $tags,$userId,  $sessionId,);
        $object = new stdClass();
        $this->extracted( $object, $filters,$tags,$userId,  $sessionId);

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = anonymizeIP($_SERVER['REMOTE_ADDR']) ?? null;
        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "filter_content", $object,$userId,$sessionId,$tags,$browser_agent,$ip_address);
    }

    public function extracted(object $object,array $filters,array $tags ,string $userId,  string $sessionId): void
    {
        $object->filters = $filters;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
        $object->tags = $tags;
    }
}
