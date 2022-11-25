<?php
namespace repalogic\tyrios\analytics\events\EcommerceEvents;
class ItemCategory
{
    public $category_name;
    public $category_id;

    /**
     * @param $category_name
     * @param $category_id
     */
    public function __construct($category_name, $category_id)
    {
        $this->category_name = $category_name;
        $this->category_id = $category_id;
    }
}