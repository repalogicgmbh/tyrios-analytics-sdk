<?php
namespace repalogic\tyrios\analytics\data;

class AnalysisData {

	public  $filters;
	public 	$target;
	public 	$group;
	
	public function __construct($filters , $target ,$group) {
		$this->filters 			= $filters;
		$this->target 			= $target;		
		$this->group 			= $group;
	}
		
	
	public function toJsonStruct() :? array {
		return [
			"filters" => $this->filters,
			"target"  => $this->target,
			"group"   => $this->group
		];		
	}

}
