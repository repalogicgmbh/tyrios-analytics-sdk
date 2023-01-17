<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\SystemInformation;
use repalogic\tyrios\analytics\data\WebEvent;
use stdClass;

class ViewItemList extends WebEvent
{
    protected string $item_list_id;
    protected string $item_list_name;
    protected array $items;
    protected string $item_list_category;
    protected array $tags;
    protected ?string $userId;
    protected ?string $sessionId;


    public function __construct(string $item_list_id, string $item_list_name,array $items,string $item_list_category, array $tags = [],
                                string $userId = "",
                                string $sessionId = "",
    )
    {
        $this->extracted($item_list_id, $this, $item_list_name, $tags, $userId,  $item_list_category, $items, $sessionId);

        $object["item_list_id"] = $item_list_id;
        $object["item_list_name"] = $item_list_name;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["item_list_category"] = $item_list_category;
        $object["items"] = $items;
        $object["sessionId"] = $sessionId;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = parent::anonymize_ip($_SERVER['REMOTE_ADDR']) ?? null;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "view_item_list", $object);
    }

    public function toJsonStruct(): array
    {
        $this->attributes["userId"] = $this->userId;
        $this->attributes["item_list_id"] = $this->item_list_id;
        $this->attributes["item_list_name"] = $this->item_list_name;
        $this->attributes["item_list_category"] = $this->item_list_category;
        $this->attributes["tags"] = $this->tags;
        $this->attributes["items"] = $this->items;
        $this->attributes["systemInformation"] = SystemInformation::getSystemInfo();
        return parent::toJsonStruct();
    }

    /**
     * @param string $item_list_id
     * @param stdClass $object
     * @param string $item_list_name
     * @param array|null $tags
     * @param string|null $userId
     * @param string $item_list_category
     * @param array $items
     * @param string|null $sessionId
     * @return void
     */
    public function extracted(string $item_list_id, object $object, string $item_list_name, ?array $tags, ?string $userId,  string $item_list_category, array $items, ?string $sessionId): void
    {
        $object->item_list_id = $item_list_id;
        $object->item_list_name = $item_list_name;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->item_list_category = $item_list_category;
        $object->items = $items;
        $object->sessionId = $sessionId;
    }

}

