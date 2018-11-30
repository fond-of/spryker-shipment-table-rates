<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Business;

use Generated\Shared\Transfer\CountryTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Generated\Shared\Transfer\DataImporterConfigurationTransfer;

interface ShipmentTableRateFacadeInterface
{
    /**
     * Retreieve Shipment Price
     *
     * @param float $price
     * @param string $countryIso2Code
     * @param string $zipCode
     * @param string $storeName
     *
     * @return float
     */
    public function getShipmentPrice(float $price, string $countryIso2Code, string $zipCode, string $storeName): float;
}