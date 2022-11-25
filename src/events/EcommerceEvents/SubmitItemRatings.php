<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\BasicEvent;
use stdClass;

class SubmitItemRatings extends BasicEvent
{
    protected string $item_name;
    protected string $item_id;
    protected string $rating;
    protected string $userId;
    protected string $sessionId;
    protected array $tags;

    public function __construct(string $item_name,
                                string $item_id,
                                string $rating,
                                array $tags = [],
                                string $userId = "",
                                string $sessionId = "",
    )
    {
        $this->extracted( $this, $item_name,$item_id,$rating, $tags,$userId,  $sessionId,);
        $object = new stdClass();
        $this->extracted( $object, $item_name,$item_id,$rating, $tags,$userId,  $sessionId);
        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "submit_item_ratings", $object);
    }

    public function extracted(object $object,string $item_name,string $item_id,string $rating, array $tags ,string $userId,  string $sessionId): void
    {
        $object->item_name = $item_name;
        $object->item_id = $item_id;
        $object->rating = $rating;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
        $object->tags = $tags;
    }
}
