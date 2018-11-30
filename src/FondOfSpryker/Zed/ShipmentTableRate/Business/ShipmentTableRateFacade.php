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
     * Retrieve Shipment price
     *
     * @param float $price
     * @param string $countryIso2Code
     * @param string $zipCode
     * @param string $storeName
     *
     * @return float
     */
    public function getShipmentPrice(float $price, string $countryIso2Code, string $zipCode, string $storeName): float
    {
        return $this->getFactory()
            ->createTableRateManager()
            ->getShipmentPrice($price, $countryIso2Code, $zipCode, $storeName);
    }

}