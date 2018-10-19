<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Business;

use Generated\Shared\Transfer\CountryTransfer;
use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\ShipmentTableRate\Business\ShipmentTableRateBusinessFactory getFactory()
 */
class ShipmentTableRateFacade extends AbstractFacade implements ShipmentTableRateFacadeInterface
{
    /**
     * @param float $price
     * @param string $countryIso2Code
     * @param string $storeName
     *
     * @return integer
     */
    public function getPriceByCountryIso2CodeAndStoreName(float $price, string $countryIso2Code, string $storeName): float
    {
        return $this->getFactory()
            ->createTableRateManager()
            ->getPriceByCountryIso2CodeAndStoreName($price, $countryIso2Code, $storeName);
    }

}