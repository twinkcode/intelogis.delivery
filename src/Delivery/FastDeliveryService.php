<?php

namespace DeliveryModule\Delivery;

class FastDeliveryService extends AbstractDeliveryService
{
    public function __construct()
    {
        parent::__construct('/fast');
    }

    public function calculatePrice(string $sourceKladr, string $targetKladr, float $weight): array
    {
        // Call the fake API to get the delivery cost and date
        $result = $this->api->apiResponse($sourceKladr, $targetKladr, $weight);

        $period = (int)$result['period'];
        $date_deadline = date("Y-m-d")." 18:00";
        $date_now    = date("Y-m-d H:i");
        $date = new \DateTime($date_now);
        if ($date_now > $date_deadline) $period += 1;
        $date->modify("+$period day");

        return [
            'price' => $result['price'],
            'date' => $date->format("Y-m-d"),
            'error' => $result['error']
        ];
    }
}
