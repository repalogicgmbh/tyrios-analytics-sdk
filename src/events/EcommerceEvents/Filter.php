<?php
namespace repalogic\tyrios\analytics\events\EcommerceEvents;

class Filter
{
    public string $filter_name;
    public ?array $tags;
    public string $filter_value;

    /**
     * @param string $filter_name
     * @param string $filter_value
     * @param ?array $tags
     */
    public function __construct(string $filter_name, string $filter_value,array $tags = [])
    {
        $this->filter_name = $filter_name;
        $this->tags = $tags;
        $this->filter_value = $filter_value;
    }

}