<?php
namespace repalogic\tyrios\analytics\data;

class BasicEvent {

	public string $eventType;
	public string $eventName;
    public string $dateTime;
	public array|null $attributes;


	public function __construct(string $dateTime,string $eventType,string $eventName,?array $attributes) {
		$this->eventType 	= $eventType;
		$this->eventName 	= $eventName;
		$this->dateTime 	= $dateTime;
		$this->attributes 	= $attributes;
	}

    public function toJsonStruct():array {
        return [
            "dateTime" => $this->dateTime,
            "eventType" => $this->eventType,
            "eventName" => $this->eventName,
            "attributes" => $this->attributes];
    }
}
