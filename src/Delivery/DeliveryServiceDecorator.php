<?php

namespace DeliveryModule\Delivery;

class DeliveryServiceDecorator implements DeliveryServiceInterface
{

    protected $deliveryService;

    public function __construct(DeliveryServiceInterface $deliveryService)
    {
        $this->deliveryService = $deliveryService;
    }

    /**
     * @inheritDoc
     */
    public function calculatePrice(string $sourceKladr, string $targetKladr, float $weight): array
    {
        $this->deliveryService->validateData($sourceKladr, $targetKladr, $weight);
        return $this->deliveryService->calculatePrice($sourceKladr, $targetKladr, $weight);
    }

    /**
     * @inheritDoc
     */
    public function validateData(string $sourceKladr, string $targetKladr, float $weight): bool
    {
        //
    }

    /**
     * @inheritDoc
     */
    public function checkKladr(string $kladr): bool
    {
        //
    }
}
