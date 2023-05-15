<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvent;

class FormSubmission extends WebEvent
{
    protected string $form_name;
    protected string $form_location;
    protected string $form_type;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(string $form_name,string $form_location,string $form_type,
                                ?string $browser_agent=null,
                                ?string $ip_address=null,
                                ?array $tags=[],
                                string $userId="",
                                string $sessionId = ""
    ){
        $this->form_name = $form_name;
        $this->form_location = $form_location;
        $this->form_type = $form_type;
        $this->tags = $tags;
        $this->userId = $userId;
        $this->sessionId = $sessionId;
        $this->browser_agent = $browser_agent;
        $this->ip_address = $ip_address;

        $object["form_name"] = $form_name;
        $object["form_location"] = $form_location;
        $object["form_type"] = $form_type;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d\TH:i:s'), "ta_web", "form_submission",$object);
    }
}

