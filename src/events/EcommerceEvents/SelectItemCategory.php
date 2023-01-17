<?php
namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvent;

class SelectItemCategory extends WebEvent
{
    protected string $category_name;
    protected string $category_id;
    protected string $sub_category_name;
    protected string $sub_category_id;
    protected array $tags;
    protected ?string $userId;
    protected ?string $sessionId;

    public function __construct(
        string $category_name,
        string $category_id,
        string $sub_category_name = "",
        string $sub_category_id = "",
        array $tags = [],
        string $userId = "",
        string $sessionId = "",
    )
    {
        $this->extracted($category_name, $this, $category_id,$sub_category_name,$sub_category_id, $tags, $userId,  $sessionId);

        $object["category_name"] = $category_name;
        $object["category_id"] = $category_id;
        $object["sub_category_name"] = $sub_category_name;
        $object["sub_category_id"] = $sub_category_id;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = parent::anonymize_ip($_SERVER['REMOTE_ADDR']) ?? null;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "select_item_category",$object);
    }

    public function extracted(string $category_name, object $object, string $category_id,?string $sub_category_name,?string $sub_category_id, ?array $tags, ?string $userId,  ?string $sessionId): void
    {
        $object->category_name = $category_name;
        $object->category_id = $category_id;
        $object->sub_category_name = $sub_category_name;
        $object->sub_category_id = $sub_category_id;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
    }
}
