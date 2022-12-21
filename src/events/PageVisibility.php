<?php
namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;

class PageVisibility extends BasicEvent {

	private string $url;
	private int $userId;
	private $pageTitle;
	private string $visibilityStatus;
	private $visibilityTime;
	private $basicEvent;
	private $sysInfo;

	public function __construct(int $userId, string $url, $pageTitle, string $visibilityStatus, $visibilityTime, SystemInformation $sysInfo) {
		$this->userId           = $userId;
		$this->url 				= $url;
		$this->pageTitle 		= $pageTitle;
		$this->visibilityStatus = $visibilityStatus;
		$this->visibilityTime 	= $visibilityTime;
		$this->sysInfo 		 	= $sysInfo;
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
