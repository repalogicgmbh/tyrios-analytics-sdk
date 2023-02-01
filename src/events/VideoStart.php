<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\WebEvent;

class VideoStart extends WebEvent
{
    protected string $video_duration;
    protected string $video_provider;
    protected string $video_title;
    protected string $video_url;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(string $video_duration,string $video_provider,string $video_title,
                                string $video_url,
                                ?string $browser_agent = null,
                                ?string $ip_address = null,
                                ?array $tags = [],
                                string $userId = "",
                                string $sessionId = ""
    ){
        $this->video_duration = $video_duration;
        $this->video_provider = $video_provider;
        $this->video_title = $video_title;
        $this->video_url = $video_url;
        $this->tags = $tags;
        $this->userId = $userId;
        $this->sessionId = $sessionId;
        $this->browser_agent = $browser_agent;
        $this->ip_address = $ip_address;

        $object["video_duration"] = $video_duration;
        $object["video_provider"] = $video_provider;
        $object["video_title"] = $video_title;
        $object["video_url"] = $video_url;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "video_start",$object);
    }
}

