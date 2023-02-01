<?php
namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use repalogic\tyrios\analytics\data\WebEvent;

class PageVisibility extends WebEvent {

	protected string $url;
    protected ?string $userId;
    protected string $pageTitle;
    protected string $visibilityStatus;
    protected string $visibilityTime;
    protected BasicEvent $basicEvent;
    protected SystemInformation $sysInfo;
    protected array|null $tags;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string|null $ip_address;

	public function __construct(string $url,string $pageTitle,string $visibilityStatus,string $visibilityTime,
                                SystemInformation $sysInfo,
                                ?string $browser_agent = null,
                                ?string $ip_address = null,
                                ?array $tags = [],
                                string $userId="",
                                string $sessionId=""
    ){
		$this->userId = $userId;
		$this->url = $url;
		$this->pageTitle = $pageTitle;
		$this->visibilityStatus = $visibilityStatus;
		$this->visibilityTime = $visibilityTime;
		$this->sysInfo = $sysInfo;
        $this->browser_agent = $browser_agent;
        $this->ip_address = $ip_address;

        $object["pageTitle"] = $pageTitle;
        $object["url"] = $url;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;
        $object["visibilityStatus"] = $visibilityStatus;
        $object["visibilityTime"] = $visibilityTime;
        $object["sysInfo"] = $sysInfo;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "page_visibility",$object);

    }
	
	public function toJsonStruct() :? array{
		return [
			"userId"			=> $this->userId,
			"pageTitle"			=> $this->pageTitle,
			"url"				=> $this->url,
			"visibilityStatus"	=> $this->visibilityStatus,
			"visibilityTime"	=> $this->visibilityTime,
			"systemInformation" => $this->sysInfo->getSystemInfo(),
            "browser_agent"     => $this->browser_agent,
            "ip_address"        => $this->ip_address
		];	
	}
}
