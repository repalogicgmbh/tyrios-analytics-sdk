<?php
namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use repalogic\tyrios\analytics\data\WebEvent;

class PageVisibility extends WebEvent {

	private string $url;
	private ?string $userId;
	private string $pageTitle;
	private string $visibilityStatus;
	private string $visibilityTime;
	private BasicEvent $basicEvent;
	private SystemInformation $sysInfo;

    protected array $tags;
    protected ?string $sessionId;

	public function __construct(string $url,string $pageTitle, string $visibilityStatus,string $visibilityTime, SystemInformation $sysInfo,array $tags,string $userId="",string $sessionId="") {
		$this->userId           = $userId;
		$this->url 				= $url;
		$this->pageTitle 		= $pageTitle;
		$this->visibilityStatus = $visibilityStatus;
		$this->visibilityTime 	= $visibilityTime;
		$this->sysInfo 		 	= $sysInfo;

        $object["pageTitle"] = $pageTitle;
        $object["url"] = $url;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;
        $object["visibilityStatus"] = $visibilityStatus;
        $object["visibilityTime"] = $visibilityTime;
        $object["sysInfo"] = $sysInfo;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = parent::anonymize_ip($_SERVER['REMOTE_ADDR']) ?? null;

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
			"systemInformation" => $this->sysInfo->getSystemInfo()
		];	
	}
}
