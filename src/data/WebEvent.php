<?php
namespace repalogic\tyrios\analytics\data;

abstract class WebEvent extends BasicEvent
{
    use BasicTrait;
    protected ?string $userId;
    protected ?string $sessionId;
    protected array|null $tags;
    protected string|null $browser_agent;
    protected string $ip_address;

    public function __construct(?string $userId,?string $sessionId,?array $tags,?string $browser_agent,string $ip_address,
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

        $this->userId = $userId;
        $this->sessionId = $sessionId;
        $this->tags = $tags;
        $this->browser_agent = $browser_agent;
        $this->ip_address = $ip_address;

        parent::__construct($dateTime, $eventType, $eventName, $attributes);
    }

    public function toJsonStruct():array {

        $this->attributes["userId"] = $this->userId;
        $this->attributes["sessionId"] = $this->sessionId;
        $this->attributes["tags"] = $this->tags;
        $this->attributes["browser_agent"] = $this->browser_agent;
        $this->attributes["ip_address"] = $this->ip_address;
        return parent::toJsonStruct();
    }
}
