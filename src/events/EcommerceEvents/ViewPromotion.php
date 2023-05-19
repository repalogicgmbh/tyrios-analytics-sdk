<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvent;
use stdClass;

class ViewPromotion extends WebEvent
{
    protected string $creative_name;
    protected string $promotion_id;
    protected array $promotion_items_list;
    protected string $promotion_name;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string $ip_address;

    public function __construct(string $creative_name,string $promotion_id,array $promotion_items_list,string $promotion_name,
                                string $ip_address,
                                ?string $browser_agent = null,
                                ?array $tags = [],
                                ?string $userId = "",
                                ?string $sessionId = "",
    ){
        $this->extracted($creative_name,$this,$promotion_id,$promotion_name,$promotion_items_list,$ip_address,$browser_agent,$tags,$userId,$sessionId);

        $object["creative_name"] = $creative_name;
        $object["promotion_id"] = $promotion_id;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["promotion_name"] = $promotion_name;
        $object["promotion_items_list"] = $promotion_items_list;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d\TH:i:s'), "ta_web", "view_promotion", $object);
    }



    /**
     * @param string $creative_name
     * @param stdClass $object
     * @param string $promotion_id
     * @param array|null $tags
     * @param string|null $userId
     * @param string $promotion_name
     * @param array $promotion_items_list
     * @param string|null $sessionId
     * @param string|null $browser_agent
     * @param string $ip_address
     * @return void
     */
    public function extracted(string $creative_name,object $object,string $promotion_id,string $promotion_name,array $promotion_items_list,
                              string $ip_address,?string $browser_agent=null,?array $tags=[],?string $userId="",?string $sessionId=""): void
    {
        $object->creative_name = $creative_name;
        $object->promotion_id = $promotion_id;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->promotion_name = $promotion_name;
        $object->promotion_items_list = $promotion_items_list;
        $object->sessionId = $sessionId;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }

}

