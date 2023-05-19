<?php

namespace repalogic\tyrios\analytics\events\EcommerceEvents;

use repalogic\tyrios\analytics\data\SystemInformation;
use repalogic\tyrios\analytics\data\WebEvent;
use stdClass;

class AddPaymentInfo extends WebEvent
{
    protected string $currency;
    protected string $value;
    protected array $items;
    protected ?string $coupon;
    protected string $payment_type;
    protected array|null $tags;
    protected ?string $userId;
    protected ?string $sessionId;
    protected string|null $browser_agent;
    protected string $ip_address;

    public function __construct(string $currency, string $value,array $items,string $payment_type,
                                string $ip_address,
                                ?string $browser_agent = null,
                                ?array $tags = [],
                                ?string $coupon = "",
                                ?string $userId = "",
                                ?string $sessionId = "",
    ){

        $this->extracted($currency,$this,$value,$payment_type,$items,$ip_address,$browser_agent,$coupon,$sessionId,$tags,$userId);

        $object["currency"] = $currency;
        $object["value"] = $value;
        $object["tags"] = $tags;
        $object["userId"] = $userId;
        $object["coupon"] = $coupon;
        $object["payment_type"] = $payment_type;
        $object["items"] = $items;
        $object["sessionId"] = $sessionId;

        parent::__construct($userId,$sessionId,$tags,$browser_agent,$ip_address,
                            date('Y-m-d\TH:i:s'), "ta_web", "add_payment_info",$object);
    }

    public function toJsonStruct(): array
    {
        $this->attributes["userId"] = $this->userId;
        $this->attributes["currency"] = $this->currency;
        $this->attributes["value"] = $this->value;
        $this->attributes["payment_type"] = $this->payment_type;
        $this->attributes["coupon"] = $this->coupon;
        $this->attributes["tags"] = $this->tags;
        $this->attributes["items"] = $this->items;
        $this->attributes["browser_agent"] = $this->browser_agent;
        $this->attributes["ip_address"] = $this->ip_address;

        return parent::toJsonStruct();
    }

    /**
     * @param string $currency
     * @param stdClass $object
     * @param string $value
     * @param array|null $tags
     * @param string|null $userId
     * @param string|null $coupon
     * @param string $payment_type
     * @param array $items
     * @param string|null $sessionId
     * @param string|null $browser_agent
     * @param string $ip_address
     * @return void
     */
    public function extracted(string $currency,object $object,string $value,string $payment_type, array $items,string $ip_address,
                              ?string $browser_agent=null,?string $coupon="",?string $sessionId="",?array $tags=[],?string $userId=""): void
    {
        $object->currency = $currency;
        $object->value = $value;
        $object->tags = $tags;
        $object->userId = $userId;
        $object->coupon = $coupon;
        $object->payment_type = $payment_type;
        $object->items = $items;
        $object->sessionId = $sessionId;
        $object->browser_agent = $browser_agent;
        $object->ip_address = $ip_address;
    }

}

