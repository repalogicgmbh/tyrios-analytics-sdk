<?php
namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\BasicEvent;
use stdClass;

class SignUp extends BasicEvent
{
    protected string $method;
    protected string $value;
    protected array $tags;
    protected ?string $userId;
    protected ?string $sessionId;

    public function __construct(string $method, string $value, array $tags = [],
                                string $userId = "",
                                string $sessionId = "",
    )
    {
        $this->extracted($method, $this, $value, $tags, $userId,  $sessionId);
        $object = new stdClass();
        $this->extracted($method, $object, $value, $tags, $userId,  $sessionId);

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = anonymizeIP($_SERVER['REMOTE_ADDR']) ?? null;
        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "signup", $object,$userId,$sessionId,$tags,$browser_agent,$ip_address);
    }

    public function extracted(string $method, object $object, string $value, ?array $tags, ?string $userId,  ?string $sessionId): void
    {
        $object->method = $method;
        $object->value = $value;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
    }
}
