<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Business;

use Spryker\Zed\Shipment\Business\ShipmentFacadeInterface as SprykerShipmentFacadeInterface;

interface ShipmentTableRateFacadeInterface extends SprykerShipmentFacadeInterface
{
    /**
     * @param float $price
     * @param string $countryIsoCode
     * @param int $storeId
     *
     * @return integer
     */
    public function getPriceByCountryCodeAndStoreId($price, $countryIsoCode, $storeId): float;
}