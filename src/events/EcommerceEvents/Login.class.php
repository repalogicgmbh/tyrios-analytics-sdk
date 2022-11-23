<?php
namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\BasicEvent;
use stdClass;

class Login extends BasicEvent
{
    protected string $method;
    protected string $value;
    protected ?array $tags;
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
        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "login", $object);
    }

    public function extracted(string $method, object $object, string $value, ?array $tags = [], ?string $userId = "",  ?string $sessionId = ""): void
    {
        $object->method = $method;
        $object->value = $value;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
    }
}
