<?php
namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\SystemInformation;
use repalogic\tyrios\analytics\data\BasicEvent;

class ServiceUsedEvent extends  BasicEvent{

	private $app;
	private $functionality;
	private $project;
	private $tags ;

	public function __construct(string $app,string $functionality,$project,array $tags =[]){
		parent::__construct(date("Y-m-d\TH:i:s\Z"), "Click", "Module");				
		$this->app 			 = $app;
		$this->functionality = $functionality;
		$this->project 		 = $project;
		$this->tags 		 = $tags;
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


