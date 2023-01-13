<?php
namespace repalogic\tyrios\analytics\data;

use stdClass;

class BasicEvent extends WebEvents {

	public  $eventType;
	public  $eventName;
    public $dateTime;
	public $attributes;


	public function __construct($dateTime, $eventType, $eventName, $attributes,
                                ?string $userID,?string $sessionID,?array $tags,?string $browser_agent,?string $ip_address) {
		$this->eventType 	= $eventType;
		$this->eventName 	= $eventName;
		$this->dateTime 	= $dateTime;
		$this->attributes 	= $attributes;

        parent::__construct($userID, $sessionID, $tags,$browser_agent,$ip_address);
	}
}
