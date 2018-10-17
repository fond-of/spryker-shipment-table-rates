<?php

namespace FondOfSpryker\Zed\ShipmentTableRate\Business;

use FondOfSpryker\Zed\ShipmentTableRate\Business\Model\TableRateManager;
use FondOfSpryker\Zed\ShipmentTableRate\ShipmentDependencyProvider;
use Spryker\Zed\Country\Persistence\CountryQueryContainerInterface;
use Spryker\Zed\Shipment\Business\ShipmentBusinessFactory as SprykerShipmentBusinessFactory;

/**
 * @method \Pyz\Zed\Shipment\Persistence\ShipmentQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Shipment\ShipmentConfig getConfig()
 */
class ShipmentTableRateBusinessFactory extends SprykerShipmentBusinessFactory
{
    /**
     * @return \Pyz\Zed\Shipment\Business\Model\TableRateManager
     */
    public function createTableRateManager(): TableRateManager
    {
        return new TableRateManager(
            $this->getQueryContainer(),
            $this->getCountryQueryContainer()
        );
    }

    /**
     * @return \Spryker\Zed\Country\Persistence\CountryQueryContainerInterface
     */
    protected function getCountryQueryContainer(): CountryQueryContainerInterface
    {
        return $this->getProvidedDependency(ShipmentTableRateDependencyProvider::QUERY_CONTAINER_COUNTRY);
    }
}
