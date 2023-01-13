<?php
namespace repalogic\tyrios\analytics\data;


abstract class WebEvents{
    protected ?string  $userID;
    protected ?string $sessionID;
    protected array $tags;
    protected string|null $browser_agent;
    protected string|null $ipAddress;

    public function __construct(?string $userID,?string $sessionID,?array $tags,?string $browser_agent,?string $ip_address){
        $this->userID = $userID;
        $this->sessionID = $sessionID;
        $this->tags = $tags;
        $this->browser_agent = $browser_agent;
        $this->ipAddress = $ip_address;
    }

}