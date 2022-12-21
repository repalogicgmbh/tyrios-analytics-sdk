<?php
namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\SystemInformation;

class WebSiteVisit {

	private $url;
	private $userId;
	private string $sourceOfVisit;
	private $timeOfVisit;
	private $basicEvent;
	private $sysInfo;
	
	public function __construct(int $userId, $url, string $sourceOfVisit, $timeOfVisit, SystemInformation $sysInfo) {
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
