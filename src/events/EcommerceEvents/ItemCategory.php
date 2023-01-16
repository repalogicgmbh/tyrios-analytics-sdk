<?php
namespace repalogic\tyrios\analytics\events\EcommerceEvents;
class ItemCategory
{
    public string $category_name;
    public string $category_id;

    /**
     * @param $category_name
     * @param $category_id
     */
    public function __construct(string $category_name,string $category_id)
    {
        $this->category_name = $category_name;
        $this->category_id = $category_id;
    }
}