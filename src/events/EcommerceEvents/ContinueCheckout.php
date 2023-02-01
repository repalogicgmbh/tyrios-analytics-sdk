<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvent;

class ContinueCheckout extends WebEvent
{
    protected string $currency;
    protected string $value;
    protected bool $purchase_made;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(string $currency,string $value,bool $purchase_made,
                                ?string $browser_agent = null,
                                ?string $ip_address = null,
                                ?array $tags = [],
                                ?string $userId = "",
                                ?string $sessionId = ""
    ){
        $this->extracted($currency,$this,$value,$purchase_made,$tags,$userId,$sessionId,$browser_agent,$ip_address);

        $object["currency"] = $currency;
        $object["value"] = $value;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["purchase_made"] = $purchase_made;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "continue_checkout", $object);
    }

    public function extracted(string $currency,object $object,string $value,bool $purchase_made,?array $tags=[],?string $userId="",
                              ?string $sessionId="",?string $browser_agent=null,?string $ip_address=null): void
    {
        $object->currency = $currency;
        $object->value = $value;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->purchase_made = $purchase_made;
        $object->sessionId = $sessionId;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }

}

