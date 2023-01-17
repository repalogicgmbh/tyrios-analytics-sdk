<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvent;

class ClickSearchResults extends WebEvent
{
    protected string $search_term;
    protected string $search_query;
    protected ?string $search_type;
    protected array $tags;
    protected ?string $sessionId;
    protected ?string $userId;

    public function __construct(string $search_term, string $search_query,string $search_type ="", array $tags = [],string $sessionId ="",$userId="")
    {
        $this->search_term = $search_term;
        $this->search_query = $search_query;
        $this->search_type = $search_type;
        $this->tags = $tags;
        $this->sessionId = $sessionId;

        $object["search_term"] = $search_term;
        $object["search_query"] = $search_query;
        $object["search_type"] = $search_type;
        $object["tags"] = $tags;
        $object["sessionId"] = $sessionId;
        $object["userId"] = $userId;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = parent::anonymize_ip($_SERVER['REMOTE_ADDR']) ?? null;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "click_search_results",$object);
    }
}

