<?php
namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use stdClass;
class PageVisibility extends BasicEvent {

	private string $url;
	private int $userId;
	private $pageTitle;
	private string $visibilityStatus;
	private $visibilityTime;
	private $basicEvent;
	private $sysInfo;

    protected array $tags;
    protected ?string $sessionId;

	public function __construct(int $userId, string $url, $pageTitle, string $visibilityStatus, $visibilityTime, SystemInformation $sysInfo,array $tags,string $sessionId) {
		$this->userId           = $userId;
		$this->url 				= $url;
		$this->pageTitle 		= $pageTitle;
		$this->visibilityStatus = $visibilityStatus;
		$this->visibilityTime 	= $visibilityTime;
		$this->sysInfo 		 	= $sysInfo;

        $object = new stdClass();
        $object->pageTitle = $pageTitle;
        $object->url = $url;
        $object->userId = $userId;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = anonymizeIP($_SERVER['REMOTE_ADDR']) ?? null;
        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "scroll",$object,$userId,$sessionId,$tags,$browser_agent,$ip_address);

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
