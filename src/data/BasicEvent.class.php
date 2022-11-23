<?php
namespace repalogic\tyrios\analytics\data;

use stdClass;

class BasicEvent {

	public  $eventType;
	public  $eventName;
    public $dateTime;
	public $attributes;

	public function __construct($dateTime, $eventType, $eventName, $attributes) {
		$this->eventType 	= $eventType;
		$this->eventName 	= $eventName;
		$this->dateTime 	= $dateTime;
		$this->attributes 	= $attributes;
	}
}
