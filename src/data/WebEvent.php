<?php
namespace repalogic\tyrios\analytics\data;

abstract class WebEvent extends BasicEvent
{
    use BasicTrait;
    protected ?string $userID;
    protected ?string $sessionID;
    protected array|null $tags;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(?string $userID,?string $sessionID,?array $tags,?string $browser_agent,?string $ip_address,
                                string $dateTime,string $eventType,string $eventName,?array $attributes)
    {
        if(!$browser_agent){
            $browser_agent = $this->getBrowserAgent();
        }
        if(!$ip_address){
            if(isset($_SERVER['REMOTE_ADDR'])){
                $ip_address = $this->getAnonymizeIP($_SERVER['REMOTE_ADDR']);
            }
        }

        $this->userID = $userID;
        $this->sessionID = $sessionID;
        $this->tags = $tags;
        $this->browser_agent = $browser_agent;
        $this->ip_address = $ip_address;

        parent::__construct($dateTime, $eventType, $eventName, $attributes);
    }

    public function toJsonStruct() :? array {

        return [
            "userID"    => $this->userID,
            "sessionID" => $this->sessionID,
            "tags"      => $this->tags,
            "browser_agent" => $this->browser_agent,
            "ip_address"    => $this->ip_address
        ];
    }
}