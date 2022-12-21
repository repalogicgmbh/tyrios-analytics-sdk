<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use stdClass;

class FormSubmission extends BasicEvent
{
    protected string $form_name;
    protected string $form_location;
    protected string $form_type;
    protected array $tags;
    protected string $userId;
    protected string $sessionId;

    public function __construct(string $form_name, string $form_location,string $form_type, array $tags = [], string $userId="", string $sessionId = "")
    {
        $this->form_name = $form_name;
        $this->form_location = $form_location;
        $this->form_type = $form_type;
        $this->tags = $tags;
        $this->userId = $userId;
        $this->sessionId = $sessionId;
        $object = new stdClass();
        $object->form_name = $form_name;
        $object->form_location = $form_location;
        $object->form_type = $form_type;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;

        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "form_submission",$object);
    }
}

