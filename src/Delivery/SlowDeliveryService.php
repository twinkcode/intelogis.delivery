<?php

namespace DeliveryModule\Delivery;

use DateTime;

class SlowDeliveryService extends AbstractDeliveryService
{

    const BASE_COST = 15;
    public function __construct()
    {
        parent::__construct('/slow');
    }

    /**
     * @inheritDoc
     */
    public function calculatePrice(string $sourceKladr, string $targetKladr, float $weight): array
    {
        // Call the fake API to get the delivery cost and date
        $result = $this->api->apiResponse($sourceKladr, $targetKladr, $weight);
        $price = self::BASE_COST * $result['coefficient'];
        return [
            'price' => $price,
            'date' => (new DateTime($result['date']))->format("Y-m-d"),
            'error' => $result['error']
        ];
    }
}
