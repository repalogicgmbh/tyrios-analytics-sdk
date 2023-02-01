<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\WebEvent;
use stdClass;

class AddShippingInfo extends WebEvent
{
    protected string $currency;
    protected string $value;
    protected array $items;
    protected ?string $coupon;
    protected string $shipping_tier;
    protected string $country;
    protected ?string $region;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string|null $ip_address;

    public function __construct(string $currency, string $value,array $items,string $shipping_tier,string $country,
                                ?string $browser_agent = null,
                                ?string $ip_address = null,
                                ?array $tags = [],
                                ?string $region = "",
                                ?string $coupon = "",
                                ?string $userId = "",
                                ?string $sessionId = "",
    ){
        $this->extracted($currency,$this,$value,$shipping_tier,$country,$items,$tags,$userId,$coupon,$region,$sessionId,$browser_agent,$ip_address);

        $object["currency"] = $currency;
        $object["value"] = $value;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["coupon"] = $coupon;
        $object["shipping_tier"] = $shipping_tier;
        $object["country"] = $country;
        $object["region"] = $region;
        $object["items"] = $items;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d H:i:s'), "ta_web", "add_shipping_info", $object);

    }


    /**
     * @param string $currency
     * @param stdClass $object
     * @param string $value
     * @param array|null $tags
     * @param string|null $userId
     * @param string|null $coupon
     * @param string $shipping_tier
     * @param string $country
     * @param string|null $region
     * @param array $items
     * @param string|null $sessionId
     * @param string|null $browser_agent
     * @param string|null $ip_address
     * @return void
     */
    public function extracted(string $currency,object $object,string $value,string $shipping_tier,string $country,array $items,
                              ?array $tags=[], ?string $userId="",?string $coupon="",?string $region="",
                              ?string $sessionId="",?string $browser_agent=null,?string $ip_address=null): void
    {
        $object->currency = $currency;
        $object->value = $value;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->coupon = $coupon;
        $object->shipping_tier = $shipping_tier;
        $object->country = $country;
        $object->region = $region;
        $object->items = $items;
        $object->sessionId = $sessionId;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;

    }

}

