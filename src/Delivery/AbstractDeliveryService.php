<?php

namespace DeliveryModule\Delivery;

use DeliveryModule\Exceptions\DeliveryException;

abstract class AbstractDeliveryService implements DeliveryServiceInterface
{
    public $baseUrl;
    protected $api;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
        $this->api = new FakeDeliveryApi($this->baseUrl);
    }


    /**
     * @inheritDoc
     */
    public function calculatePrice(string $sourceKladr, string $targetKladr, float $weight): array
    {

        $this->validateData($sourceKladr, $targetKladr, $weight);

        // Call the fake API to get the delivery cost and date
        $result = $this->api->apiResponse($sourceKladr, $targetKladr, $weight);

        return [
            'price' => $result['price'],
            'date' => $result['date'],
            'error' => $result['error']
        ];
    }

    /**
     * @inheritDoc
     */
    public function validateData(string $sourceKladr, string $targetKladr, float $weight): bool
    {
        // Проверяем данные на корректность
        if (!$this->checkKladr($sourceKladr)) throw new DeliveryException('Некорректный код КЛАДР откуда');
        if (!$this->checkKladr($targetKladr)) throw new DeliveryException('Некорректный код КЛАДР куда');

        if (!isset($weight) || !is_numeric($weight) || $weight <= 0) {
            throw new DeliveryException('Некорректный вес посылки');
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function checkKladr(string $kladr): bool
    {
        // TODO: добавить реализацию метода для проверки кода КЛАДР через DaData, по закомментированному образцу ниже
        // $token = env("DADATA_API_KEY");
        // $secret = env("DADATA_SECRET_KEY");
        // $dadata = new Dadata($token, $secret);
        // $dadata->init();
        // $fields = array("query" => $kladr, "count" => 1);
        // $result = $dadata->findById("address", $fields);
        // if ($result['suggestions']['data']['region_kladr_id'] ?? false) return true;

        // в условия задачи проверка не входит, просто возвращаем true, если нет очевидных ошибок
        if (is_numeric($kladr) && strlen($kladr) > 5 && strlen($kladr) < 20) {
            return true;
        } else return false;
    }


}
