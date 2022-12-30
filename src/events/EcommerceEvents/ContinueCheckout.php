<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use stdClass;

class ContinueCheckout extends BasicEvent
{
    protected string $currency;
    protected string $value;
    protected bool $purchase_made;
    protected array $tags;
    protected ?string $userId;
    protected ?string $sessionId;

    public function __construct(string $currency, string $value,
                                bool   $purchase_made,
                                array  $tags = [],
                                string $userId = "",
                                string $sessionId = ""
    )
    {
        $this->extracted($currency, $this, $value, $tags, $userId, $purchase_made, $sessionId);

        $object = new stdClass();

        $this->extracted($currency, $object, $value, $tags, $userId, $purchase_made, $sessionId);

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = anonymizeIP($_SERVER['REMOTE_ADDR']) ?? null;
        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "continue_checkout", $object,$userId,$sessionId,$tags,$browser_agent,$ip_address);
    }

    public function extracted(string $currency, object $object, string $value, ?array $tags, ?string $userId, bool $purchase_made, ?string $sessionId): void
    {
        $object->currency = $currency;
        $object->value = $value;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->purchase_made = $purchase_made;
        $object->sessionId = $sessionId;
    }

}

