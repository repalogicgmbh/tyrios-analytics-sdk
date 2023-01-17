<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvent;
use stdClass;

class ViewPromotion extends WebEvent
{
    protected string $creative_name;
    protected string $promotion_id;
    protected array $promotion_items_list;
    protected ?string $promotion_name;
    protected array $tags;
    protected ?string $userId;
    protected ?string $sessionId;


    public function __construct(string $creative_name, string $promotion_id, array $promotion_items_list, string $promotion_name , array $tags = [],
                                string $userId = "",
                                string $sessionId = "",
    )
    {
        $this->extracted($creative_name, $this, $promotion_id, $tags, $userId, $promotion_name,  $promotion_items_list, $sessionId);

        $object["creative_name"] = $creative_name;
        $object["promotion_id"] = $promotion_id;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["promotion_name"] = $promotion_name;
        $object["promotion_items_list"] = $promotion_items_list;
        $object["sessionId"] = $sessionId;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = parent::anonymize_ip($_SERVER['REMOTE_ADDR']) ?? null;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "view_promotion", $object);
    }



    /**
     * @param string $creative_name
     * @param stdClass $object
     * @param string $promotion_id
     * @param array|null $tags
     * @param string|null $userId
     * @param string|null $promotion_name
     * @param array $promotion_items_list
     * @param string|null $sessionId
     * @return void
     */
    public function extracted(string $creative_name, object $object, string $promotion_id, ?array $tags, ?string $userId, ?string $promotion_name, array $promotion_items_list, ?string $sessionId): void
    {
        $object->creative_name = $creative_name;
        $object->promotion_id = $promotion_id;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->promotion_name = $promotion_name;
        $object->promotion_items_list = $promotion_items_list;
        $object->sessionId = $sessionId;
    }

}

