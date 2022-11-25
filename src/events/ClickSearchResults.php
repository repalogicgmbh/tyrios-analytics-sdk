<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use stdClass;

class ClickSearchResults extends BasicEvent
{
    protected string $search_term;
    protected string $search_query;
    protected ?string $search_type;
    protected ?array $tags;
    protected ?string $sessionId;
    protected ?string $userId;

    public function __construct(string $search_term, string $search_query,string $search_type ="", array $tags = [],string $sessionId ="",$userId="")
    {
        $this->search_term = $search_term;
        $this->search_query = $search_query;
        $this->search_type = $search_type;
        $this->tags = $tags;
        $this->sessionId = $sessionId;
        $object = new stdClass();
        $object->search_term = $search_term;
        $object->search_query = $search_query;
        $object->search_type = $search_type;
        $object->tags = $tags;
        $object->sessionId = $sessionId;
        $object->userId = $userId;
        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "click_search_results",$object);
    }
}

