<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use stdClass;

class ViewItem extends BasicEvent
{
    protected string $currency;
    protected string $value;
    protected $items;
    protected ?array $tags;
    protected ?string $userId;
    protected ?string $sessionId;


    public function __construct(string $currency, string $value, $items, array $tags = [],
                                string $userId = "",
                                string $sessionId = "",
    )
    {
        $this->extracted($currency, $this, $value, $tags, $userId,  $items, $sessionId);

        $object = new stdClass();

        $this->extracted($currency, $object, $value, $tags, $userId,  $items, $sessionId);

        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "view_item", $object);
    }

    public function toJsonStruct(): array
    {
        $this->attributes["userId"] = $this->userId;
        $this->attributes["currency"] = $this->currency;
        $this->attributes["value"] = $this->value;
        $this->attributes["tags"] = $this->tags;
        $this->attributes["items"] = $this->items;
        $this->attributes["systemInformation"] = SystemInformation::getSystemInfo();
        return parent::toJsonStruct();
    }

    /**
     * @param string $currency
     * @param stdClass $object
     * @param string $value
     * @param array|null $tags
     * @param string|null $userId
     * @param array $items
     * @param string|null $sessionId
     * @return void
     */
    public function extracted(string $currency, object $object, string $value, ?array $tags, ?string $userId,  array $items, ?string $sessionId): void
    {
        $object->currency = $currency;
        $object->value = $value;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->items = $items;
        $object->sessionId = $sessionId;
    }

}

