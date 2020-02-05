<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\ShipmentTableRate\Business\ShipmentTableRateBusinessFactory getFactory()
 */
class ShipmentTableRateFacade extends AbstractFacade implements ShipmentTableRateFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $price
     * @param string $countryIso2Code
     * @param string $zipCode
     * @param string $storeName
     *
     * @throws \Exception
     *
     * @return int
     */
    public function getShipmentPrice(
        int $price,
        string $countryIso2Code,
        string $zipCode,
        string $storeName
    ): int {
        return $this->getFactory()
            ->createTableRateManager()
            ->getShipmentPrice($price, $countryIso2Code, $zipCode, $storeName);
    }
}
