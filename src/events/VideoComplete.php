<?php

namespace repalogic\tyrios\analytics\events;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use stdClass;

class VideoComplete extends BasicEvent
{
    protected $video_duration;
    protected $tags;
    protected $userId;
    protected $video_provider;
    protected $video_title;
    protected $video_url;

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
        $object = new stdClass();
        $object->video_duration = $video_duration;
        $object->video_provider = $video_provider;
        $object->video_title = $video_title;
        $object->video_url = $video_url;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->sessionId = $sessionId;
        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "video_complete",$object);
    }
}

