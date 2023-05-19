<?php
namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvent;

class Share extends WebEvent
{
    protected string $share_type;
    protected string $share_platform;
    protected string $share_item_id;
    protected string $share_item_name;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string $ip_address;

    public function __construct(string $share_type,string $share_platform,string $share_item_id,string $share_item_name,
                                string $ip_address,
                                ?string $browser_agent=null,
                                ?array $tags = [],
                                ?string $userId = "",
                                ?string $sessionId = "",
    ){
        $this->extracted($share_type,$this,$share_platform,$share_item_id,$share_item_name,$ip_address,$browser_agent,$tags,$userId,$sessionId);

        $object["share_type"] = $share_type;
        $object["share_platform"] = $share_platform;
        $object["share_item_id"] = $share_item_id;
        $object["share_item_name"] = $share_item_name;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d\TH:i:s'), "ta_web", "share", $object);
    }

    public function extracted(string $share_type,object $object,string $share_platform,string $share_item_id,string $share_item_name,
                              string $ip_address,?string $browser_agent=null,?array $tags=[],?string $userId="",?string $sessionId=""): void
    {
        $object->share_type = $share_type;
        $object->share_platform = $share_platform;
        $object->share_item_id = $share_item_id;
        $object->share_item_name = $share_item_name;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }
}
