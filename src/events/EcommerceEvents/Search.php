<?php
namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvents;

class Search extends WebEvents
{
    protected string $search_term;
    protected bool $autosuggest;
    protected array $tags;
    protected ?string $userId;
    protected ?string $sessionId;

    public function __construct(string $search_term, bool $autosuggest = false, array $tags = [],
                                string $userId = "",
                                string $sessionId = "",
    )
    {
        $this->extracted($search_term, $this, $autosuggest, $tags, $userId,  $sessionId);

        $object["search_term"] = $search_term;
        $object["autosuggest"] = $autosuggest;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = parent::anonymize_ip($_SERVER['REMOTE_ADDR']) ?? null;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "search", $object);
    }

    public function extracted(string $search_term, object $object, bool $autosuggest, ?array $tags, ?string $userId,  ?string $sessionId): void
    {
        $object->search_term = $search_term;
        $object->autosuggest = $autosuggest;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
    }
}
