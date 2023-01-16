<?php
namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\SystemInformation;
use repalogic\tyrios\analytics\data\WebEvents;

class ServiceUsedEvent extends  WebEvents {

	private string $app;
	private string $functionality;
	private $project;
	protected array $tags ;

    protected ?string $userId;
    protected ?string $sessionId;

	public function __construct(string $app,string $functionality,$project,array $tags =[],string $sessionId="",string $userId=""){
        $this->app 			 = $app;
		$this->functionality = $functionality;
		$this->project 		 = $project;
		$this->tags 		 = $tags;

        $this->userId = $userId;
        $this->sessionId = $sessionId;
        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = parent::anonymize_ip($_SERVER['REMOTE_ADDR']) ?? null;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date("Y-m-d\TH:i:s\Z"), "Click", "Module",null);

    }
	
	public function toJsonStruct() :? array {
		
		$systemInfo = new SystemInformation();
		$this->attributes = [
				"app" 				=> $this->app,
				"functionality"  	=> $this->functionality,
				"project"	 		=> $this->project,
				"tags"				=> $this->tags,
 				"systemInformation" => SystemInformation::getSystemInfo()		
		];

		return  parent::toJsonStruct();	
	}
}


