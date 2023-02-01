<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\SystemInformation;
use repalogic\tyrios\analytics\data\WebEvent;
use stdClass;

class ViewItem extends WebEvent
{
    protected string $currency;
    protected string $value;
    protected Item $item;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(string $currency,string $value,Item $item,
                                ?string $browser_agent = null,
                                ?string $ip_address = null,
                                ?array $tags = [],
                                ?string $userId = "",
                                ?string $sessionId = "",
    )
    {
        $this->extracted($currency,$this,$value,$item,$tags,$userId,$sessionId,$browser_agent,$ip_address);

        $object["currency"] = $currency;
        $object["value"] = $value;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["item"] = $item;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "view_item", $object);
    }

    public function toJsonStruct(): array
    {
        $this->attributes["userId"] = $this->userId;
        $this->attributes["currency"] = $this->currency;
        $this->attributes["value"] = $this->value;
        $this->attributes["tags"] = $this->tags;
        $this->attributes["item"] = $this->item;
        $this->attributes["systemInformation"] = SystemInformation::getSystemInfo();
        $this->attributes["browser_agent"] = $this->browser_agent;
        $this->attributes["ip_address"] = $this->ip_address;
        return parent::toJsonStruct();
    }

    /**
     * @param string $currency
     * @param stdClass $object
     * @param string $value
     * @param array|null $tags
     * @param string|null $userId
     * @param Item $item
     * @param string|null $sessionId
     * @param string|null $browser_agent
     * @param string|null $ip_address
     * @return void
     */
    public function extracted(string $currency,object $object,string $value,Item $item,?array $tags=[],?string $userId="",
                              ?string $sessionId="",?string $browser_agent=null,?string $ip_address=null): void
    {
        $object->currency = $currency;
        $object->value = $value;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->item = $item;
        $object->sessionId = $sessionId;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }

}

