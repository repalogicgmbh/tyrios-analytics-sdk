<?php
namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvent;

class PageVisibility extends WebEvent {

	protected string $url;
    protected ?string $userId;
    protected string $pageTitle;
    protected string $visibilityStatus;
    protected string $visibilityTime;
    protected array|null $tags;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string $ip_address;

	public function __construct(string $url,string $pageTitle,string $visibilityStatus,string $visibilityTime,
                                string $ip_address,
                                ?string $browser_agent = null,
                                ?array $tags = [],
                                string $userId="",
                                string $sessionId=""
    ){
		$this->userId = $userId;
		$this->url = $url;
		$this->pageTitle = $pageTitle;
		$this->visibilityStatus = $visibilityStatus;
		$this->visibilityTime = $visibilityTime;
        $this->browser_agent = $browser_agent;
        $this->ip_address = $ip_address;

        $object["pageTitle"] = $pageTitle;
        $object["url"] = $url;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;
        $object["visibilityStatus"] = $visibilityStatus;
        $object["visibilityTime"] = $visibilityTime;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d\TH:i:s'), "ta_web", "page_visibility",$object);

    }

	public function toJsonStruct() : array{
		return [
			"userId"			=> $this->userId,
			"pageTitle"			=> $this->pageTitle,
			"url"				=> $this->url,
			"visibilityStatus"	=> $this->visibilityStatus,
			"visibilityTime"	=> $this->visibilityTime,
            "browser_agent"     => $this->browser_agent,
            "ip_address"        => $this->ip_address
		];
	}
}
