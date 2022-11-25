<?php
namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use stdClass;

class PageView extends BasicEvent{

	protected string $url;
	protected ?array $tags;
	protected string $userId;
	protected string $sessionId;
	protected string $pageTitle;
	protected ?string $ip_address;
	protected ?string $previous_page;

	public function __construct(string $url, string $pageTitle,  string $ip_address = "",string $previous_page = "",array $tags=[],string $userId = "", string $sessionId = ""){
		$this->userId 		= $userId;
		$this->sessionId 		= $sessionId;
        $this->previous_page = $previous_page;
        $this->tags = $tags;
		$this->url 			= $url;
		$this->pageTitle 	= $pageTitle;
		$this->ip_address 	= $ip_address;

        $object = new stdClass();
        $object->pageTitle = $pageTitle;
        $object->url = $url;
        $object->tags = $tags;
        $object->userId 		= $userId;
        $object->sessionId 		= $sessionId;
        $object->ip_address = $ip_address;
        $object->previous_page = $previous_page;
        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "pageView" ,$object);
    }

}
