<?php
namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvent;

class PageView extends WebEvent {

	protected string $url;
	protected array|null $tags;
	protected ?string $userId;
	protected ?string $sessionId;
	protected string $pageTitle;
	protected string|null $ip_address;
	protected string|null $previous_page;
    protected string|null $browser_agent;

	public function __construct(string $url,string $pageTitle,?string $ip_address = null,
                                ?string $browser_agent = null,
                                ?string $previous_page = null,
                                ?array $tags = [],
                                string $userId = "",
                                string $sessionId = ""
    ){
        $this->tags = $tags;
        $this->url 	= $url;
        $this->userId = $userId;
        $this->sessionId = $sessionId;
        $this->pageTitle = $pageTitle;
        $this->ip_address = $ip_address;
        $this->previous_page = $previous_page;
        $this->browser_agent = $browser_agent;

        $object["url"]  = $url;
        $object["tags"] = $tags;
        $object["pageTitle"] = $pageTitle;
        $object["userId"] 	 = $userId;
        $object["sessionId"] = $sessionId;
        $object["ip_address"] = $ip_address;
        $object["previous_page"] = $previous_page;
        $object["browser_agent"] = $browser_agent;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "pageView" ,$object);
    }

}
