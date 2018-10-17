<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Business;

use Spryker\Zed\Shipment\Business\ShipmentFacade as SprykerShipmentFacade;

/**
 * @method \Pyz\Zed\Shipment\Business\ShipmentBusinessFactory getFactory()
 */
class ShipmentFacade extends SprykerShipmentFacade implements ShipmentFacadeInterface
{
    /**
     * @param float $price
     * @param string $countryIsoCode
     * @param int $storeId
     *
     * @return integer
     */
    public function getPriceByCountryCodeAndStoreId($price, $countryIsoCode, $storeId): float
    {
        return $this->getFactory()
            ->createTableRateManager()
            ->getPriceByCountryCodeAndStoreId($price, $countryIsoCode, $storeId);
    }
}
