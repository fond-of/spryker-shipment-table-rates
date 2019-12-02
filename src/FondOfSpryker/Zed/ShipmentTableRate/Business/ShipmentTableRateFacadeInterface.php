<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Business;

interface ShipmentTableRateFacadeInterface
{
    /**
     * Specifications:
     * - Retrieves shipping price by table rates
     *
     * @api
     *
     * @param int $price
     * @param string $countryIso2Code
     * @param string $zipCode
     * @param string $storeName
     *
     * @return int
     */
    public function getShipmentPrice(
        int $price,
        string $countryIso2Code,
        string $zipCode,
        string $storeName
    ): int;
}
