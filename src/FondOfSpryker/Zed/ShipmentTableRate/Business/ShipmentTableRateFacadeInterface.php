<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Business;

use Generated\Shared\Transfer\CountryTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Generated\Shared\Transfer\DataImporterConfigurationTransfer;

interface ShipmentTableRateFacadeInterface
{
    /**
     * @param int $price
     * @param string $countryIso2Code
     * @param string $zipCode
     * @param string $storeName
     *
     * @return int
     */
    public function getShipmentPrice(int $price, string $countryIso2Code, string $zipCode, string $storeName): int;
}