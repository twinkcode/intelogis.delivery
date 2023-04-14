<?php

namespace DeliveryModule\Delivery;

use DeliveryModule\Exceptions\DeliveryException;

class FakeDeliveryApi
{
    protected $baseUrl;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * Метод для имитации возврата стоимости или коэфициента и даты доставки
     *
     * @param string $sourceKladr КЛАДР откуда везем
     * @param string $targetKladr КЛАДР куда везем
     * @param float $weight Вес отправления в кг
     * @return array Массив с ценой или коэфициентом и датой доставки, описанном в задании
     * @throws DeliveryException
     */
    public function apiResponse(string $sourceKladr, string $targetKladr, float $weight): array
    {

//        // Имитация ошибки при расчете стоимости
//        if ($weight > 3000) {
//            throw new DeliveryException('Превышен максимальный вес посылки');
//        }

        // Имитация расчета даты доставки
        $deliveryDate = date('Y-m-d', strtotime('+' . mt_rand(1, 3) . ' days'));

        require_once __DIR__ . '/../helpers.php';

        $error = mt_rand(1, 100) > 85 ? generateRandomString(mt_rand(3, 5)) : null;

        switch ($this->baseUrl) {
            case '/fast':
                return [
                    'price' => rand_float(1, 1500),
                    'period' => mt_rand(1, 15),
                    'error' => $error
                ];
            case '/slow':
                return [
                    'coefficient' => rand_float(1, 30),
                    'date' => $deliveryDate,
                    'error' => $error
                ];
            default :
                throw new DeliveryException('Не указан путь к api');
        }
    }
}
