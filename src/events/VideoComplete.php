<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvents;

class VideoComplete extends WebEvents
{
    protected string $video_duration;
    protected array $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string $video_provider;
    protected string $video_title;
    protected string $video_url;

    public function __construct(string $video_duration,
                                string $video_provider,
                                string $video_title,
                                string $video_url,
                                array $tags = [], string $userId ="",string $sessionId = ""
    )
    {
        $this->video_duration = $video_duration;
        $this->video_provider = $video_provider;
        $this->video_title = $video_title;
        $this->video_url = $video_url;
        $this->tags = $tags;
        $this->userId = $userId;
        $this->sessionId = $sessionId;

        $object["video_duration"] = $video_duration;
        $object["video_provider"] = $video_provider;
        $object["video_title"] = $video_title;
        $object["video_url"] = $video_url;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = parent::anonymize_ip($_SERVER['REMOTE_ADDR']) ?? null;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "video_complete",$object);
    }
}

