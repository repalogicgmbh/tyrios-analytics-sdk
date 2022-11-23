<?php

namespace repalogic\tyrios\analytics\data;

use repalogic\tyrios\analytics\util\TyriosLogin;
use stdClass;

class AnalyticsSender
{
    private $user;
    private $password;
    private $userAgent;
    private $branch;
    private $postCode;
    private $countryCode;

    public function __construct($user, $password,$branch,$postCode,$countryCode)
    {
        $this->user = $user;
        $this->password = $password;
        $this->branch = $branch;
        $this->postCode = $postCode;
        $this->countryCode = $countryCode;
        $ua = $this->getBrowser();
        $user_agent = "Browser:" . $ua['name'] . "|" . "Version:" . $ua['version'] . "|" . "Reports:" . $ua['userAgent'];
        $this->userAgent = $user_agent;
    }

    public function tyriosLogin()
    {
        $accessToken = new TyriosLogin($this->user, $this->password);
        return $accessToken;
    }

    public function sendEvents($basicEvents)
    {
        $url = "http://localhost:8014/addEvent";
        $curl = curl_init();
        $object = new stdClass();
        $location = new stdClass();
        $location->postCode = $this->postCode;
        $location->countryCode = $this->countryCode;
        $object->events = array_map(function ($each) use ($location) {

            $each->userAgent = $this->userAgent;
            $each->branch = $this->branch;
            $each->location = $location;
            return $each;
        }, $basicEvents);
        $request = $object;
        echo json_encode($request);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($request));

        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "$this->user:$this->password");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {
            die("Connection Failure");
        }
        curl_close($curl);
        return $result;
    }

    public function filterEvent(AnalysisData $analysisData)
    {
        $accessToken = new TyriosLogin($this->user, $this->password);

        $url = "https://analytics.tyrios.io/analysisFilter";
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Basic {$accessToken->accesstoken()}"
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($analysisData->toJsonStruct()));

        $response = curl_exec($curl);
        if ($response === false) {
            return curl_error($curl);
        }
        return $response;

    }

    public function getBrowser()
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/OPR/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Chrome/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        } elseif (preg_match('/Edge/i', $u_agent)) {
            $bname = 'Edge';
            $ub = "Edge";
        } elseif (preg_match('/Trident/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }
        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version = $matches['version'][0];
            } else {
                $version = $matches['version'][1];
            }
        } else {
            $version = $matches['version'][0];
        }

        // check if we have a number
        if ($version == null || $version == "") {
            $version = "?";
        }

        return array(
            'userAgent' => $u_agent,
            'name' => $bname,
            'version' => $version,
            'platform' => $platform,
            'pattern' => $pattern
        );
    }
}

