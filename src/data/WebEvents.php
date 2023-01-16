<?php
namespace repalogic\tyrios\analytics\data;

abstract class WebEvents extends BasicEvent
{
    protected ?string $userID;
    protected ?string $sessionID;
    protected array $tags;
    protected string|null $browser_agent;
    protected string|null $ipAddress;

    public function __construct(?string $userID,?string $sessionID,array $tags,?string $browser_agent,?string $ip_address,
                                string $dateTime,string $eventType,string $eventName,?array $attributes)
    {
        $this->userID = $userID;
        $this->sessionID = $sessionID;
        $this->tags = $tags;
        $this->browser_agent = $browser_agent;
        $this->ipAddress = $ip_address;

        parent::__construct($dateTime, $eventType, $eventName, $attributes);
    }

    public function toJsonStruct() :? array {

        return [
            "userID"    => $this->userID,
            "sessionID" => $this->sessionID,
            "tags"      => $this->tags,
            "browser_agent" => $this->browser_agent,
            "ip_address"    => $this->ipAddress
        ];
    }

    public function anonymize_ip($ip){
        return preg_replace(
            ['/\.\d*$/', '/[\da-f]*:[\da-f]*$/'],
            ['.XXX', 'XXXX:XXXX'],
            $ip
        );
    }


}