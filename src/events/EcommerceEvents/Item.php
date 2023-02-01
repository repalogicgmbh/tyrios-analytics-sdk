<?php
namespace repalogic\tyrios\analytics\events\EcommerceEvents;

class Item
{
    public string $item_id;
    public string $item_name;
    public ?string $affiliation;
    public ?string $currency;
    public ?array $tags;
    public ?float $discount;
    public ?int $index;
    public ?string $item_brand;
    public ?array $item_categories;
    public ?string $item_list_id;
    public ?string $item_category_id;
    public ?string $item_list_name;
    public ?string $item_variant;
    public string $item_group;
    public float $netPrice;
    public int $quantity;
    public string|null $item_season;
    public array|null $item_colors;
    public string|null $item_gender;
    public string|null $ageGroup;
    public string|null $deliveryTimeGroup;
    public string|null $GroupProduct;
    public string|null $item_pattern;
    public array|null $item_material;
    public string|null $countryOfOrigin;
    public string|null $item_size;

    /**
     * @param string $item_id
     * @param string $item_name
     * @param ?string $affiliation;
     * @param ?string $currency;
     * @param ?array $tags;
     * @param float|null $discount;
     * @param int|null $index;
     * @param ?string $item_brand;
     * @param ?array $item_categories;
     * @param ?string $item_list_id;
     * @param ?string $item_category_id;
     * @param ?string $item_list_name;
     * @param ?string $item_variant;
     * @param string $item_group;
     * @param float $netPrice;
     * @param int $quantity;
     * @param ?string $item_season;
     * @param array|null $item_colors;
     * @param string|null $item_gender;
     * @param string|null $ageGroup;
     * @param string|null $deliveryTimeGroup;
     * @param string|null $GroupProduct;
     * @param string|null $item_pattern;
     * @param array|null $item_material;
     * @param string|null $countryOfOrigin;
     * @param string|null $item_size;
     */
    public function __construct(string $item_id,string $item_name,float $netPrice,int $quantity,string $item_group,
                                ?string $item_season="",
                                ?array $tags = [],
                                ?string $affiliation = "",
                                ?string $currency = "",
                                ?float $discount = 0,
                                ?int $index = null,
                                ?string $item_brand = "",
                                ?string $item_list_id = "",
                                ?string $item_category_id = "",
                                ?string $item_list_name = "",
                                ?string $item_variant = "",
                                ?array $item_categories = [],
                                ?array $item_colors = [],
                                ?string $item_gender = "",
                                ?string $ageGroup = "",
                                ?string $deliveryTimeGroup = "",
                                ?string $GroupProduct = "",
                                ?string $item_pattern = "",
                                ?array $item_material = [],
                                ?string $countryOfOrigin = "",
                                ?string $item_size = ""
    ){
        $this->item_id = $item_id;
        $this->item_name = $item_name;
        $this->affiliation = $affiliation;
        $this->currency = $currency;
        $this->tags = $tags;
        $this->discount = $discount;
        $this->index = $index;
        $this->item_brand = $item_brand;
        $this->item_categories = $item_categories;
        $this->item_list_id = $item_list_id;
        $this->item_category_id = $item_category_id;
        $this->item_list_name = $item_list_name;
        $this->item_variant = $item_variant;
        $this->item_season = $item_season;
        $this->item_group = $item_group;
        $this->netPrice = $netPrice;
        $this->quantity = $quantity;
        $this->item_colors = $item_colors;
        $this->item_gender = $item_gender;
        $this->ageGroup = $ageGroup;
        $this->deliveryTimeGroup = $deliveryTimeGroup;
        $this->GroupProduct = $GroupProduct;
        $this->item_pattern = $item_pattern;
        $this->item_material = $item_material;
        $this->countryOfOrigin = $countryOfOrigin;
        $this->item_size = $item_size;
    }
}
