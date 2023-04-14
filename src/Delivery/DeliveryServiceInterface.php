<?php

namespace DeliveryModule\Delivery;

use DeliveryModule\Exceptions\DeliveryException;

interface DeliveryServiceInterface
{
    /**
     * Рассчитывает стоимость и сроки доставки.
     *
     * @param string $sourceKladr КЛАДР откуда везем
     * @param string $targetKladr КЛАДР куда везем
     * @param float $weight Вес отправления в кг
     * @return array Результат расчета стоимости и сроков доставки в виде массива с ключами "price", "date" и "error"
     * @throws DeliveryException
     */
    public function calculatePrice(string $sourceKladr, string $targetKladr, float $weight): array;

    /**
     * Метод для проверки корректности входных данных
     *
     * @param string $sourceKladr КЛАДР откуда везем
     * @param string $targetKladr КЛАДР куда везем
     * @param float $weight Вес отправления в кг
     * @return bool
     * @throws DeliveryException Если данные некорректны
     */
    public function validateData(string $sourceKladr, string $targetKladr, float $weight): bool;

    /**
     * Метод для проверки кода КЛАДР
     *
     * @param string $kladr Код КЛАДР для проверки
     * @return bool Результат проверки: true, если код КЛАДР корректный, false в противном случае
     */
    public function checkKladr(string $kladr): bool;

}
