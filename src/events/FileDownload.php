<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\SystemInformation;
use repalogic\tyrios\analytics\data\WebEvent;

class FileDownload extends WebEvent
{
    protected string $file_extension;
    protected string $file_name;
    protected array $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string $link_classes;
    protected string $link_domain;
    protected string $link_id;
    protected string $link_text;
    protected string $link_url;

    public function __construct(string $file_extension, string $file_name, string $link_classes = "",
                                string $link_domain = "", string $link_id = "", string $link_text = "", string $link_url = "",
                                array $tags = [],
                                string $userId="",
                                string $sessionId=""
    )
    {
        $this->file_extension = $file_extension;
        $this->file_name = $file_name;
        $this->tags = $tags;
        $this->userId = $userId;
        $this->link_classes = $link_classes;
        $this->link_domain = $link_domain;
        $this->link_id = $link_id;
        $this->link_text = $link_text;
        $this->link_url = $link_url;
        $this->sessionId = $sessionId;

        $object["file_extension"] = $file_extension;
        $object["file_name"] = $file_name;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;
        $object["link_classes"] = $link_classes;
        $object["link_domain"] = $link_domain;
        $object["link_id"] = $link_id;
        $object["link_text"] = $link_text;
        $object["link_url"] = $link_url;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = parent::anonymize_ip($_SERVER['REMOTE_ADDR']) ?? null;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "file_download",$object);
    }

    public function toJsonStruct(): array
    {
        $this->attributes["userId"] = $this->userId;
        $this->attributes["file_extension"] = $this->file_extension;
        $this->attributes["file_name"] = $this->file_name;
        $this->attributes["tags"] = $this->tags;
        $this->attributes["link_classes"] = $this->link_classes;
        $this->attributes["link_domain"] = $this->link_domain;
        $this->attributes["link_id"] = $this->link_id;
        $this->attributes["link_text"] = $this->link_text;
        $this->attributes["link_url"] = $this->link_url;
        $this->attributes["systemInformation"] = SystemInformation::getSystemInfo();
        return parent::toJsonStruct();
    }

}

