<?php
namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvent;

class Login extends WebEvent
{
    protected string $method;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string $ip_address;

    public function __construct(string $method,string $ip_address,
                                ?string $browser_agent = null,
                                ?array $tags = [],
                                ?string $userId = "",
                                ?string $sessionId = "",
    )
    {
        $this->extracted($method,$this,$ip_address,$browser_agent,$tags,$userId,$sessionId);

        $object["method"] = $method;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                        date('Y-m-d\TH:i:s'), "ta_web", "login", $object);
    }

    public function extracted(string $method,object $object,string $ip_address,?string $browser_agent=null,
                              ?array $tags=[],?string $userId="",?string $sessionId=""): void
    {
        $object->method = $method;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }
}
