<?php
namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use repalogic\tyrios\analytics\data\WebEvent;

class WebSiteVisit extends WebEvent {

	private string $url;
	private string $userId;
	private string $sourceOfVisit;
	private string $timeOfVisit;
	private BasicEvent $basicEvent;
	private SystemInformation $sysInfo;

	public function __construct(string $userId,string $url,string $sourceOfVisit,string $timeOfVisit,SystemInformation $sysInfo) {
		$this->userId = $userId;
		$this->url = $url;
		$this->sourceOfVisit = $sourceOfVisit;
		$this->timeOfVisit = $timeOfVisit;
		$this->sysInfo = $sysInfo;
	}

	public function toJsonStruct() :? array {
		return [
			"userId"			=> $this->userId,
			"sourceOfVisit"		=> $this->sourceOfVisit,
			"url"				=> $this->url,
			"timeOfVisit"	    => $this->timeOfVisit,
			"systemInformation" => $this->sysInfo->getSystemInfo()
		];
	}
}
