<?php
namespace repalogic\tyrios\analytics\data;
//use repalogic\tyrios\analytics\util\BrowserDetection;

class SystemInformation {

	public static function getSystemInfo() {
		//$browser = new BrowserDetection();
		$useragent = $_SERVER["HTTP_USER_AGENT"];
        //return $browser->getAll($useragent);
        return $useragent;
	}
}
