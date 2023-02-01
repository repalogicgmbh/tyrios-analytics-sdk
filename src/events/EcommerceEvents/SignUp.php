<?php
namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvent;

class SignUp extends WebEvent
{
    protected string $method;
    protected string $value;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(string $method,string $value,?string $browser_agent = null,
                                ?string $ip_address = null,
                                ?array $tags = [],
                                ?string $userId = "",
                                ?string $sessionId = "",
    )
    {
        $this->extracted($method,$this,$value,$tags,$userId,$sessionId,$browser_agent,$ip_address);

        $object["method"] = $method;
        $object["value"] = $value;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "signup", $object);
    }

    public function extracted(string $method,object $object,string $value,?array $tags=[],?string $userId="",
                              ?string $sessionId="",?string $browser_agent=null,?string $ip_address=null): void
    {
        $object->method = $method;
        $object->value = $value;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }
}
