<?php
namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvent;

class Search extends WebEvent
{
    protected string $search_term;
    protected bool $autosuggest;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string $ip_address;

    public function __construct(string $search_term,string $ip_address,
                                ?string $browser_agent = null,
                                bool $autosuggest = false,
                                ?array $tags = [],
                                string $userId = "",
                                string $sessionId = "",
    )
    {
        $this->extracted($search_term,$this,$autosuggest,$ip_address,$browser_agent,$tags,$userId,$sessionId);

        $object["search_term"] = $search_term;
        $object["autosuggest"] = $autosuggest;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d\TH:i:s'), "ta_web", "search", $object);
    }

    public function extracted(string $search_term,object $object,bool $autosuggest,string $ip_address,?string $browser_agent=null,
                              ?array $tags=[],?string $userId="",?string $sessionId=""): void
    {
        $object->search_term = $search_term;
        $object->autosuggest = $autosuggest;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }
}
