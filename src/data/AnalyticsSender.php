<?php

namespace repalogic\tyrios\analytics\data;

use stdClass;

class AnalyticsSender
{
    private $user;
    private $password;
    private $userAgent;
    private $branch;
    private $postCode;
    private $countryCode;
    private $debugMode = false;

    public function __construct($user, $password,$branch,$postCode,$countryCode,$debugMode = false  )
    {
        $this->user = $user;
        $this->password = $password;
        $this->branch = $branch;
        $this->postCode = $postCode;
        $this->countryCode = $countryCode;
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $this->debugMode = $debugMode;
    }

    public function sendEvents($basicEvents)
    {
        $endpoint = 'https://analytics.tyrios.io/addEventAsync';
        $object = new stdClass();
        $location = new stdClass();
        $location->postCode = $this->postCode;
        $location->countryCode = $this->countryCode;
        $object->events = array_map(function ($each) use ($location) {
            $each->branch = $this->branch;
            $each->location = $location;
            return $each->toJsonStruct();
        }, $basicEvents);

        $postData = json_encode($object,$this->debugMode?JSON_PRETTY_PRINT:0);

        $endpointParts = parse_url($endpoint);
        $endpointParts['path'] = $endpointParts['path'] ?? '/';
        $endpointParts['port'] = $endpointParts['port'] ?? $endpointParts['scheme'] === 'https' ? 443 : 80;

        $contentLength = strlen($postData);

        $request = "POST {$endpointParts['path']} HTTP/1.1\r\n";
        $request .= "Host: {$endpointParts['host']}\r\n";
        $request .= "Authorization: Basic ".base64_encode($this->user.":".$this->password)."\r\n";
        $request .= "Content-Length: {$contentLength}\r\n";
        $request .= "Connection: close\r\n";
        $request .= "Content-Type: application/json\r\n\r\n";

        $request .= $postData;

        $prefix = substr($endpoint, 0, 8) === 'https://' ? 'tls://' : '';

        $socket = fsockopen($prefix.$endpointParts['host'], $endpointParts['port']);
        fwrite($socket, $request);

        if ($this->debugMode) {
            echo '<pre>';
            echo "Request:\r\n";
            echo $request;
            while ($line = fgets($socket)) {
                $line = trim($line);
                if ($line == '') {
                    break;
                }
            }
            $output = '';
            // Read the body of the response
            while ($line = fgets($socket)) {
                $output .= $line;
            }
            echo "Response:\r\n";
            echo $output;
            echo '</pre>';
        }
        fclose($socket);

    }

    public function filterEvent(AnalysisData $analysisData)
    {
        $accessToken = base64_encode( "{$this->user}:{$this->password}");
        $url = "https://analytics.tyrios.io/analysisFilter";
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Basic {$accessToken}"
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($analysisData->toJsonStruct()));

        $response = curl_exec($curl);
        if ($response === false) {
            return curl_error($curl);
        }
        return $response;

    }
}
