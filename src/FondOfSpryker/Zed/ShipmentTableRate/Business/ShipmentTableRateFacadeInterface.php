<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Business;

use Generated\Shared\Transfer\CountryTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Generated\Shared\Transfer\DataImporterConfigurationTransfer;

interface ShipmentTableRateFacadeInterface
{
    /**
     * @param float $price
     * @param string $countryIso2Code
     * @param string $storeName
     *
     * @return integer
     */
    public function getPriceByCountryIso2CodeAndStoreName(float $price, string $countryIso2Code, string $storeName): float;
}