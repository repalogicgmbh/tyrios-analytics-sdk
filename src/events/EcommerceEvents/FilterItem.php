<?php
namespace repalogic\tyrios\analytics\events\EcommerceEvents;
class FilterItem
{
    public string $filter_name;
    public string $filter_value;
    public array $tags;

    public function __construct(string $filter_name,string $filter_value,array $tags = [])
    {
        $this->filter_name = $filter_name;
        $this->filter_value = $filter_value;
        $this->tags = $tags;
    }
}