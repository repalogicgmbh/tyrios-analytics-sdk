<?php
namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvent;

class SelectItemCategory extends WebEvent
{
    protected string $category_name;
    protected string $category_id;
    protected ?string $sub_category_name;
    protected ?string $sub_category_id;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string $ip_address;

    public function __construct(string $category_name,string $category_id,string $ip_address,
                                ?string $browser_agent = null,
                                ?array $tags = [],
                                ?string $sub_category_name = "",
                                ?string $sub_category_id = "",
                                ?string $userId = "",
                                ?string $sessionId = "",
    )
    {
        $this->extracted($category_name,$this,$category_id,$ip_address,$browser_agent,$sub_category_name,$sub_category_id,$tags,$userId,$sessionId);

        $object["category_name"] = $category_name;
        $object["category_id"] = $category_id;
        $object["sub_category_name"] = $sub_category_name;
        $object["sub_category_id"] = $sub_category_id;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d\TH:i:s'), "ta_web", "select_item_category",$object);
    }

    public function extracted(string $category_name,object $object,string $category_id,string $ip_address,?string $browser_agent=null,
                              ?string $sub_category_name="",?string $sub_category_id="",?array $tags=[],?string $userId="",?string $sessionId=""): void
    {
        $object->category_name = $category_name;
        $object->category_id = $category_id;
        $object->sub_category_name = $sub_category_name;
        $object->sub_category_id = $sub_category_id;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }
}
