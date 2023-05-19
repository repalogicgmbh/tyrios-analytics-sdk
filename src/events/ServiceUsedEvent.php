<?php
namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\SystemInformation;
use repalogic\tyrios\analytics\data\WebEvent;

class ServiceUsedEvent extends WebEvent {

    protected string $app;
    protected string $functionality;
    protected string $project;
	protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string $ip_address;

	public function __construct(string $app,string $functionality,string $project,string $ip_address,
                                ?string $browser_agent = null,
                                ?array $tags = [],
                                string $sessionId = "",
                                string $userId = ""
    ){
        $this->app = $app;
        $this->functionality = $functionality;
        $this->project = $project;
        $this->tags = $tags;
        $this->userId = $userId;
        $this->sessionId = $sessionId;
        $this->browser_agent = $browser_agent;
        $this->ip_address = $ip_address;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d\TH:i:s'), "Click", "Module",null);

    }

	public function toJsonStruct() :array {
		$this->attributes = [
            "app" 				=> $this->app,
            "functionality"  	=> $this->functionality,
            "project"	 		=> $this->project,
            "tags"				=> $this->tags,
            "browser_agent"     => $this->browser_agent,
            "ip_address"        => $this->ip_address
		];
		return  parent::toJsonStruct();
	}
}


