<?php
namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvents;

class PageView extends WebEvents {

	protected string $url;
	protected array $tags;
	protected ?string $userId;
	protected ?string $sessionId;
	protected string $pageTitle;
	protected string $ip_address;
	protected ?string $previous_page;

	public function __construct(string $url, string $pageTitle,  string $ip_address = "",string $previous_page = "",array $tags=[],string $userId = "", string $sessionId = ""){
		$this->userId 		= $userId;
		$this->sessionId 		= $sessionId;
        $this->previous_page = $previous_page;
        $this->tags = $tags;
		$this->url 			= $url;
		$this->pageTitle 	= $pageTitle;
		$this->ip_address 	= $ip_address;

        $object["pageTitle"] = $pageTitle;
        $object["url"] = $url;
        $object["tags"] = $tags;
        $object["userId"] 		= $userId;
        $object["sessionId"] 		= $sessionId;
        $object["ip_address"] = $ip_address;
        $object["previous_page"] = $previous_page;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "pageView" ,$object);
    }

}
