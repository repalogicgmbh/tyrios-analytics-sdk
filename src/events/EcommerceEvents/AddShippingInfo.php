<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\BasicEvent;
use repalogic\tyrios\analytics\data\SystemInformation;
use stdClass;

class AddShippingInfo extends BasicEvent
{
    protected string $currency;
    protected string $value;
    protected array $items;
    protected ?string $coupon;
    protected string $shipping_tier;
    protected string $country;
    protected ?string $region;
    protected array $tags;
    protected ?string $userId;
    protected ?string $sessionId;

    public function __construct(string $currency, string $value,array $items,
                                string $shipping_tier,
                                string $country,
                                string $region = "",
                                string $coupon = "",
                                array $tags = [],
                                string $userId = "",
                                string $sessionId = "",
    )
    {
        $this->extracted($currency, $this, $value, $tags, $userId, $coupon, $shipping_tier, $country, $region, $items, $sessionId);

        $object = new stdClass();

        $this->extracted($currency, $object, $value, $tags, $userId, $coupon, $shipping_tier, $country, $region, $items, $sessionId);
        $browser_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
        $ip_address = anonymizeIP($_SERVER['REMOTE_ADDR']) ?? null;
        parent::__construct(date('Y-m-d H:i:s'), "ta_web", "add_shipping_info", $object,$userId,$sessionId,$tags,$browser_agent,$ip_address);

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
     * @return void
     */
    public function extracted(string $currency, object $object, string $value, ?array $tags, ?string $userId, ?string $coupon, string $shipping_tier, string $country, ?string $region,array $items, ?string $sessionId): void
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
    }

}

