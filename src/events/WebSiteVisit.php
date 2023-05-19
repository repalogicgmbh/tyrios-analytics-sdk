<?php
namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;

class WebSiteVisit {

	private string $url;
	private string $userId;
	private string $sourceOfVisit;
	private string $timeOfVisit;

	public function __construct(string $userId,string $url,string $sourceOfVisit,string $timeOfVisit) {
		$this->userId = $userId;
		$this->url = $url;
		$this->sourceOfVisit = $sourceOfVisit;
		$this->timeOfVisit = $timeOfVisit;
	}

	public function toJsonStruct() : array {
		return [
			"userId"			=> $this->userId,
			"sourceOfVisit"		=> $this->sourceOfVisit,
			"url"				=> $this->url,
			"timeOfVisit"	    => $this->timeOfVisit
		];
	}
}
