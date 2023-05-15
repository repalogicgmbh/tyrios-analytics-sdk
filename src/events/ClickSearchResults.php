<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvent;

class ClickSearchResults extends WebEvent
{
    protected string $search_term;
    protected ?string $search_query;
    protected ?string $search_type;
    protected array|null $tags;
    protected ?string $sessionId;
    protected ?string $userId;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(string $search_term,?string $search_query="",?string $browser_agent=null,?string $ip_address=null,
                                ?array $tags=[],
                                string $search_type ="",
                                string $sessionId ="",
                                string $userId=""
    ){
        $this->search_term = $search_term;
        $this->search_query = $search_query;
        $this->search_type = $search_type;
        $this->tags = $tags;
        $this->sessionId = $sessionId;
        $this->browser_agent = $browser_agent;
        $this->ip_address = $ip_address;

        $object["search_term"] = $search_term;
        $object["search_query"] = $search_query;
        $object["search_type"] = $search_type;
        $object["tags"] = $tags;
        $object["sessionId"] = $sessionId;
        $object["userId"] = $userId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d\TH:i:s'), "ta_web", "click_search_results",$object);
    }
}

