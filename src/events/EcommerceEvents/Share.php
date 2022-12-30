<?php
namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\BasicEvent;
use stdClass;

class Share extends BasicEvent
{
    protected string $share_type;
    protected string $share_platform;
    protected string $share_item_id;
    protected string $share_item_name;
    protected array $tags;
    protected string $userId;
    protected string $sessionId;

    public function __construct(string $share_type, string $share_platform,string $share_item_id,
                                string $share_item_name,
                                array $tags = [],
                                string $userId = "",
                                string $sessionId = "",
    )
    {
        $this->extracted($share_type, $this, $share_platform,$share_item_id,$share_item_name, $tags, $userId,  $sessionId);
        $object = new stdClass();
        $this->extracted($share_type, $object, $share_platform,$share_item_id,$share_item_name, $tags, $userId,  $sessionId);

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = anonymizeIP($_SERVER['REMOTE_ADDR']) ?? null;
        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "share", $object,$userId,$sessionId,$tags,$browser_agent,$ip_address);
    }

    public function extracted(string $share_type, object $object, string $share_platform,string $share_item_id,string $share_item_name, ?array $tags, ?string $userId,  ?string $sessionId): void
    {
        $object->share_type = $share_type;
        $object->share_platform = $share_platform;
        $object->share_item_id = $share_item_id;
        $object->share_item_name = $share_item_name;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
    }
}
