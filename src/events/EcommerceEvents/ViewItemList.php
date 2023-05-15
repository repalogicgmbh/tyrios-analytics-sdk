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
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(string $item_list_id, string $item_list_name,array $items,string $item_list_category,
                                ?string $browser_agent = null,
                                ?string $ip_address = null,
                                ?array $tags = [],
                                ?string $userId = "",
                                ?string $sessionId = "",
    ){
        $this->extracted($item_list_id,$this,$item_list_name,$item_list_category,$items,$tags,$userId,$sessionId,$browser_agent,$ip_address);

        $object["item_list_id"] = $item_list_id;
        $object["item_list_name"] = $item_list_name;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["item_list_category"] = $item_list_category;
        $object["items"] = $items;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d\TH:i:s'), "ta_web", "view_item_list", $object);
    }

    public function toJsonStruct(): array
    {
        $this->attributes["userId"] = $this->userId;
        $this->attributes["item_list_id"] = $this->item_list_id;
        $this->attributes["item_list_name"] = $this->item_list_name;
        $this->attributes["item_list_category"] = $this->item_list_category;
        $this->attributes["tags"] = $this->tags;
        $this->attributes["items"] = $this->items;
//        $this->attributes["systemInformation"] = SystemInformation::getSystemInfo();
        $this->attributes["browser_agent"] = $this->browser_agent;
        $this->attributes["ip_address"] = $this->ip_address;
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
    public function extracted(string $item_list_id,object $object,string $item_list_name,string $item_list_category,array $items,
                              ?array $tags=[],?string $userId="",?string $sessionId="",?string $browser_agent=null,?string $ip_address=null): void
    {
        $object->item_list_id = $item_list_id;
        $object->item_list_name = $item_list_name;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->item_list_category = $item_list_category;
        $object->items = $items;
        $object->sessionId = $sessionId;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }

}

